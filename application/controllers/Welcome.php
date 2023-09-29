<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_transaksi');
	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function send()
	{
		$message = "Bayara lah Dulu";
		$number = "6281375078785";
		$this->M_transaksi->SendWA($number, $message);
	}
}
