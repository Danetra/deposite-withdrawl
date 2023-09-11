require("dotenv").config();
const db = require("../../Databases/database");
const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");

const JWT_KEY = process.env.JWT_KEY;

const loginService = async (request) => {
  let username = request.username;
  let password = request.password;
  let { user, count } = await getUser(username);
  let token = "";
  if (count === 1) {
    if (await bcrypt.compare(password, user.password)) {
      token = generateToken(user);

      return token;
    } else {
      return 400;
    }
  } else {
    return 404;
  }
};

const getUser = async (username) => {
  var result = await db.query(`SELECT * FROM users where username = $1`, [
    username
  ]);
  return { user: result.rows[0], count: result.rowCount };
};

const generateToken = (user, time = 3600 * 2) => {
  let name = Buffer.from(user.name).toString("base64");
  return jwt.sign(
    {
      id: user.id,
      name: name
    },
    JWT_KEY,
    { expiresIn: time }
  );
};

module.exports = { loginService };
