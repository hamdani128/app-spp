<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    private $payload;
    public function __construct()
    {
        parent::__construct();
        $this->payload = json_decode(file_get_contents("php://input"), true);
        $this->userid = $this->session->userdata("user_id");
        $this->now = date("Y-m-d H:i:s");
        $this->level = $this->session->userdata('level');
    }

    public function index()
    {
        $data = [
            'level' => $this->level,
            'content' => 'pages/profile_siswa',
        ];
        $this->load->view('layout/index', $data);
    }
}
