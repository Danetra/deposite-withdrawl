const { verifyToken } = require("../../Middlewares/verifyToken");
const wdController = require("../../Controllers/Withdrawal/WithdrawalController");

const wdRoutes = [
  {
    method: "post",
    route: "wd",
    controller: wdController.withdrawal,
    middleware: verifyToken
  },
  {
    method: "post",
    route: "withdrawal",
    controller: wdController.withdrawalResponse,
    middleware: verifyToken
  }
];

module.exports = wdRoutes;
