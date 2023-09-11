const { verifyToken } = require("../../Middlewares/verifyToken");
const walletController = require("../../Controllers/Wallet/WalletController");

const walletRoutes = [
  {
    method: "get",
    route: "wallet/:id",
    controller: walletController.wallet,
    middleware: verifyToken
  }
];

module.exports = walletRoutes;
