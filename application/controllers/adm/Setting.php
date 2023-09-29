<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    private $payload;
    private $userid;
    private $now;
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
        $this->payload = json_decode(file_get_contents("php://input"), true);
        $this->userid = $this->session->userdata("user_id");
        $this->now = date("Y-m-d H:i:s");
        $this->level = $this->session->userdata('level');
    }

    public function index()
    {
        $data = [
            'level' => $this->level,
            'content' => 'pages/setting',
        ];
        $this->load->view('layout/index', $data);
    }


    public function getdata_api()
    {
        $query = $this->db->get('settings')->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }
}
