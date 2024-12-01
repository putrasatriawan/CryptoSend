<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionModel extends CI_Model {

    public function save_transaction($sender_address, $receiver_address, $amount)
    {
        // Simpan data transaksi di database MySQL
        $data = [
            'sender_address' => $sender_address,
            'receiver_address' => $receiver_address,
            'amount' => $amount,
            'status' => 'pending'
        ];
        $this->db->insert('transactions', $data);
    }
}
