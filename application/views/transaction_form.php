<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockchain Transaction</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.1/web3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Send Transaction</h2>
    <form id="transaction_form">
        <input type="text" id="sender_address" placeholder="Sender Address" value="0x820" required><br>
        <input type="text" id="receiver_address" placeholder="Receiver Address" value="0xc3" required><br>
        <input type="number" id="amount" placeholder="Amount (ETH)" required><br>
        <button type="submit">Send</button>
    </form>


    <script>
        const web3 = new Web3("http://127.0.0.1:7545");  
        const contractAddress = "0x1";  // Ganti dengan contract address yang Anda dapatkan dari Ganache
        const contractABI = [
			{
      "anonymous": false,
      "inputs": [
        {
          "indexed": true,
          "internalType": "address",
          "name": "sender",
          "type": "address"
        },
        {
          "indexed": true,
          "internalType": "address",
          "name": "receiver",
          "type": "address"
        },
        {
          "indexed": false,
          "internalType": "uint256",
          "name": "amount",
          "type": "uint256"
        }
      ],
      "name": "TransactionSent",
      "type": "event"
    },
    {
      "inputs": [
        {
          "internalType": "address",
          "name": "receiver",
          "type": "address"
        }
      ],
      "name": "sendTransaction",
      "outputs": [],
      "stateMutability": "payable",
      "type": "function",
      "payable": true
    }
            // Tambahkan ABI lainnya jika perlu
        ];  // Ganti dengan ABI yang Anda dapatkan dari Transaction.json

        // Membuat kontrak instance
        const contract = new web3.eth.Contract(contractABI, contractAddress);

        // Mengirim transaksi menggunakan AJAX
        $("#transaction_form").on("submit", async function(event) {
            event.preventDefault();

            const senderAddress = $("#sender_address").val();
            const receiverAddress = $("#receiver_address").val();
            const amount = $("#amount").val();

            const amountInWei = web3.utils.toWei(amount, 'ether');  // Convert ke Wei

            try {
                // Kirim transaksi menggunakan Web3.js
                await contract.methods.sendTransaction(receiverAddress).send({
                    from: senderAddress,
                    value: amountInWei
                });

                // Setelah transaksi berhasil, kirim data ke backend menggunakan AJAX
                // $.ajax({
                //     url: 'localhost/Transaction/send_transaction', // URL backend
                //     type: 'POST',
                //     contentType: 'application/json',
                //     data: JSON.stringify({
                //         sender_address: senderAddress,
                //         receiver_address: receiverAddress,
                //         amount: amount
                //     }),
                //     success: function(response) {
                //         alert('Transaction Successful!');
                //     },
                //     error: function(xhr, status, error) {
                //         console.error('Error:', error);
                //         alert('Transaction Failed!');
                //     }
                // });

            } catch (error) {
                console.error('Transaction Failed:', error);
                alert('Transaction Failed!');
            }
        });
    </script>
</body>
</html>
