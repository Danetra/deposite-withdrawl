const authController = require("../../Controllers/Auth/AuthController");

const authRoutes = [
  {
    method: "post",
    route: "login",
    controller: authController.login,
  },
];

module.exports = authRoutes;
