require("dotenv").config();
const jwt = require("jsonwebtoken");
const axios = require("axios");
const db = require("../../Databases/database");
const moment = require("moment");

const JWT_KEY = process.env.JWT_KEY;

const WithdrawalServices = async (req, url) => {
  let token = req.header("Authorization");

  let header = {
    headers: {
      Authorization: token,
      "Content-Type": "application/json"
    }
  };

  let data = {
    order_id: req.body.order_id,
    amount: req.body.amount,
    timestamp: moment(req.body.timestamp, "YYYY-MM-DD HH:mm:ss", true).format(
      "YYYY-MM-DD HH:mm:ss"
    )
  };

  try {
    const response = await axios.post(url, data, header);
    return response.data;
  } catch (error) {
    console.log(error);
    throw new Error("Failed to perform topup");
  }
};

const WithdrawalExecute = async (req, res) => {
  let token = req.header("Authorization");

  const { order_id, amount, timestamp } = req.body;

  if (token) {
    var id = "";
    var name = "";
    jwt.verify(token.split(" ")[1], JWT_KEY, (err, decode) => {
      if (err) {
        console.log(err);
      } else {
        id = decode.id;
        name = Buffer.from(decode.name, "base64").toString("utf-8");
      }
    });
  } else {
    return res.status(401).json({
      status: false,
      message: "Unauthorized"
    });
  }

  var response;
  if (
    (order_id === undefined && !order_id) ||
    (amount === undefined && !amount) ||
    (timestamp === undefined && !timestamp)
  ) {
    response = {
      code: 400,
      status: false,
      data: {
        status: "2",
        message: "Failed to Insert"
      }
    };
  } else {
    await walletUpdate(id, amount);

    response = {
      code: 200,
      status: true,
      data: {
        status: "1",
        message: "Success",
        data: {
          order_id: req.body.order_id,
          amount: req.body.amount
        }
      }
    };
  }
  return response;
};

const walletUpdate = async (userId, bodyAmount) => {
  try {
    let getWallet = await db.query(
      `SELECT user_id, total_amount from wallet WHERE user_id = ${userId}`
    );

    let countId = getWallet.rowCount;
    let amount = getWallet.rows[0].total_amount;
    let total_amount = amount - bodyAmount;

    let queryUpdated =
      "UPDATE wallet SET total_amount = $1, updated_at = $2 WHERE user_id = $3";

    let bodyUpdated = [
      total_amount,
      moment().format("YYYY-MM-DD HH:mm:ss"),
      userId
    ];

    let queryInserted =
      "INSERT INTO wallet (user_id, total_amount, currency, created_at, updated_at) VALUES ($1, $2, $3)";

    let bodyInsert = [
      userId,
      total_amount,
      "IDR",
      moment().format("YYYY-MM-DD HH:mm:ss"),
      moment().format("YYYY-MM-DD HH:mm:ss")
    ];

    if (countId > 0) {
      await db.query(queryUpdated, bodyUpdated);
    } else {
      await db.query(queryInserted, bodyInsert);
    }
  } catch (error) {
    console.error(`Gagal memperbarui dompet pelanggan: ${error}`);
    throw new Error("Gagal memperbarui dompet pelanggan");
  }
};

module.exports = { WithdrawalServices, WithdrawalExecute };
