const Transaction = artifacts.require("Transaction");

module.exports = function(deployer) {
  deployer.deploy(Transaction, { gas: 6721975 });  // Menambahkan gas limit
};
