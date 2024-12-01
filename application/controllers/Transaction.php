<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TransactionModel');
    }

    public function index()
    {
        $this->load->view('transaction_form');
    }

    public function send_transaction()
    {
        $sender_address = $this->input->post('sender_address');

        $receiver_address = $this->input->post('receiver_address');
        $amount = $this->input->post('amount');

        $this->TransactionModel->save_transaction($sender_address, $receiver_address, $amount);

        echo json_encode(['status' => 'success']);
    }
}
