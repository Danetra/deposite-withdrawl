require("dotenv").config();
const jwt = require("jsonwebtoken");
const axios = require("axios");
const db = require("../../Databases/database");
const moment = require("moment");

const JWT_KEY = process.env.JWT_KEY;

const WalletServices = async (req, res) => {
  try {
    let userId = req.params.id;
    let query =
      "SELECT a.*, b.* FROM users as a INNER JOIN wallet as b ON b.user_id = a.id WHERE a.id = $1";
    let values = [userId];

    let response = await db.query(query, values);
    return response.rows[0];
  } catch (error) {
    console.log(error);
  }
};

module.exports = { WalletServices };
