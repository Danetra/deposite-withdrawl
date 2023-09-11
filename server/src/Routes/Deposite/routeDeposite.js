const { verifyToken } = require("../../Middlewares/verifyToken");
const depoController = require("../../Controllers/Deposite/DepositeController");

const depoRoutes = [
  {
    method: "post",
    route: "topup",
    controller: depoController.topup,
    middleware: verifyToken
  },
  {
    method: "post",
    route: "deposite",
    controller: depoController.deposite,
    middleware: verifyToken
  }
];

module.exports = depoRoutes;
