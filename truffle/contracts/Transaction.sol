// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract Transaction {

    event TransactionSent(address indexed sender, address indexed receiver, uint amount);

    function sendTransaction(address receiver) public payable {
        require(msg.value > 0, "Amount should be greater than 0");

        // Mengirim dana ke penerima
        payable(receiver).transfer(msg.value);

        emit TransactionSent(msg.sender, receiver, msg.value);
    }
}
