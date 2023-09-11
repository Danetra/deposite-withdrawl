const router = require("express").Router();
const authRoutes = require("./Auth/routeAuth");
const depoRoutes = require("./Deposite/routeDeposite");
const wdRoutes = require("./Withdrawal/routeWithdrawal");
const walletRoutes = require("./Wallet/routeWallet");
const baseAPI = "/api/v1";

router.get("/api/v1", async (req, res) => {
  res.status(200).json("Coding Collectives API V.1");
});

// Auth Function
authRoutes.forEach((auth) => {
  router[auth.method](`${baseAPI}/${auth.route}`, auth.controller);
});

depoRoutes.forEach((depo) => {
  router[depo.method](
    `${baseAPI}/${depo.route}`,
    depo.middleware,
    depo.controller
  );
});

wdRoutes.forEach((wd) => {
  router[wd.method](`${baseAPI}/${wd.route}`, wd.middleware, wd.controller);
});

walletRoutes.forEach((wallet) => {
  router[wallet.method](
    `${baseAPI}/${wallet.route}`,
    wallet.middleware,
    wallet.controller
  );
});

module.exports = router;
