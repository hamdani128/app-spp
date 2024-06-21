<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        $this->level = $this->session->userdata("level");
    }
    public function index()
    {
        $data = [
            'level' => $this->level,
            'content' => 'pages/master/sdm',
        ];
        $this->load->view('layout/index', $data);
    }

    public function getdata()
    {
        $query = $this->db->get('sdm')->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function KodeAutoNumber(){
        // Mendapatkan tahun dan bulan saat ini dalam format YYMM
        $yearMonth = date('ym');
        // Menghasilkan tiga angka acak
        $randomNumber = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        // Menggabungkan tahun, bulan, dan angka acak menjadi satu kode
        $kode = $yearMonth . $randomNumber;
        return $kode;
    }

    public function insert(){
        date_default_timezone_set("Asia/Jakarta");
        $data = [
            'kode' => $this->KodeAutoNumber(),
            'fullname' => $this->payload['fullname'],
            'jenis_kelamin' => $this->payload['jk'],
            'jabatan' => $this->payload['jabatan'],
            'status' => 'Non Active',
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now
        ];
        $query = $this->db->insert('sdm', $data);
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

    public function update(){
        date_default_timezone_set("Asia/Jakarta");
        $id = $this->payload['id'];
        $data = [
            'fullname' => $this->payload['fullname'],
            'jenis_kelamin' => $this->payload['jk'],
            'jabatan' => $this->payload['jabatan'],
            'user_id' => $this->userid,
            'updated_at' => $this->now
        ];
        $query = $this->db->where("id", $id)->update('sdm', $data);
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
        $this->db->delete('sdm', array('id' => $id));
        $response = array(
            'status' => 'success',
            'message' => 'Data meja berhasil dihapus'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function aktivasi_akun(){
        $id = $this->payload['id'];
        $kode = $this->payload['kode'];
        $fullname = $this->payload['fullname'];
        $passwoord = "admin123";
        $passwoord_hash = md5($passwoord);

        $data1 = array(
            'username' => $kode,
            'password' => $passwoord,
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now,
        );

        $data2 = array(
            'fullname' => $fullname,
            'username' => $kode,
            'password' => $passwoord_hash,
            'email' => '-',
            'level' => 'Reporting',
            'inititated' => 'Administratif / Keuangan',
            'created_at' => $this->now,
            'updated_at' => $this->now,
        );

        $data3 = array(
            'status' => 'Active',
            'user_id' => $this->userid,
            'updated_at' => $this->now,
        );

        $query1 = $this->db->insert('password_history', $data1);
        $query2 = $this->db->insert('users', $data2);
        $query3 = $this->db->where('id', $id)->update('sdm', $data3);
        if ($query1 && $query2 && $query3) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Activated Account'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

}