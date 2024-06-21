<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $level;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->session->sess_expiration = '60s';
        $this->session->sess_expire_on_close = 'true';
        if ($this->session->userdata('log_in') != "login") {
            redirect(base_url("auth/login"));
        }
        $this->level = $this->session->userdata('level');
        $this->load->model('M_transaksi');
    }

    public function index()
    {
        if ($this->level == "Super Admin" || $this->level == "Reporting") {
            $data = [
                'level' => $this->level,
                'content' => 'pages/home',
            ];
        } else if ($this->level == "siswa") {
            $data = [
                'level' => $this->level,
                'content' => 'pages/home_siswa',
            ];
        }
        $this->load->view('layout/index', $data);
    }
}
