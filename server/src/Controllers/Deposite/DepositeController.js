const {
  TopupServices,
  DepositeServices
} = require("../../Services/Deposite/DepositeServices");

const topup = async (req, res) => {
  try {
    let url = "http://localhost:2023/api/v1/deposite";
    let depo = await TopupServices(req, url);
    res.status(200).json(depo);
  } catch (error) {
    // console.error(error);
    res.status(500).json({ error: "Failed to perform topup" });
  }
};

const deposite = async (req, res) => {
  let response = await DepositeServices(req);
  // console.log(response);
  res.status(200).json(response);
};

module.exports = { topup, deposite };
