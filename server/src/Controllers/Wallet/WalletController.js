const { WalletServices } = require("../../Services/Wallet/WalletServices");

const wallet = async (req, res) => {
  const response = await WalletServices(req);
  console.log(response);
  let wallet = {
    id: response.id,
    fullName: response.name,
    username: response.username,
    currency: response.currency,
    wallet_values: response.total_amount
  };
  return res.status(200).json({
    status: 200,
    data: wallet
  });
};

module.exports = { wallet };
