<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $payload;
    public function __construct()
    {
        parent::__construct();
        $this->payload = json_decode(file_get_contents('php://input'), true);
    }


    public function index()
    {
        $this->load->view('auth/login');
    }

    public function cek_login()
    {
        $username = $this->payload['username'];
        $password = $this->payload['password'];

        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        $cek = $this->db->where($where)->get('users')->row();
        // var_dump($cek);
        if (!empty($cek)) {
            $data_session = array(
                'username' => $cek->username,
                'fullname' => $cek->fullname,
                'email' => $cek->email,
                'level' => $cek->level,
                'log_in' => "login",
                'user_id' => $cek->id,
            );
            $this->session->set_userdata($data_session);
            $response = [
                'status' => 'success',
                'message' => 'Login successful',
            ];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            // echo "Username dan password salah !";
            $response = [
                'status' => 'gagal',
                'message' => 'Username dan password salah !',
            ];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }
}
