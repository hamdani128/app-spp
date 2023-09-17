<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
        $this->level = $this->session->userdata("level  ");
    }
    public function index()
    {
        $data = [
            'level' => $this->level,
            'content' => 'pages/master/kelas',
        ];
        $this->load->view('layout/index', $data);
    }

    public function getdata()
    {
        $query = $this->db->get('kelas')->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function insert()
    {

        $kelas = $this->payload['kelas'];
        $data = [
            'kelas' => $kelas,
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now
        ];
        $query = $this->db->insert('kelas', $data);
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Insert'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function update()
    {
        $id = $this->payload['id'];
        $kelas = $this->payload['kelas'];
        $data = [
            'kelas' => $kelas,
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now
        ];
        $query = $this->db->where('id', $id)->update('kelas', $data);
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Updated'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id)
    {
        $this->db->delete('kelas', array('id' => $id));
        $response = array(
            'status' => 'success',
            'message' => 'Data meja berhasil dihapus'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
