<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spp extends CI_Controller
{
    private $payload;
    private $userid;
    private $level;
    private $now;
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
        $bulanArray = array(
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $data = [
            'level' => $this->level,
            'bulanArray' => $bulanArray,
            'content' => 'pages/master/spp',
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
        foreach ($this->payload['data'] as $row) {
            $kelas_id = $row['kelas_id'];
            $kelas = $row['kelas'];
            $bulan = $row['bulan'];
            $semester = $row['semester'];
            $iuran = $row['iuran'];
            $denda = $row['denda'];
            $data = [
                'kelas_id' => $kelas_id,
                'semester' => $semester,
                'bulan' => $bulan,
                'iuran' => $iuran,
                'denda' => $denda,
                'user_id' => $this->userid,
                'created_at' => $this->now,
                'updated_at' => $this->now
            ];
            $query = $this->db->insert('info_spp', $data);
        }
        $response = array(
            'status' => 'success',
            'message' => 'Successfully Insert'
        );
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


    public function getdata_kelas_id($kelas_id)
    {
        $SQL = "SELECT
                b.kelas as kelas,
                a.*
                FROM info_spp a LEFT JOIN kelas b
                ON a.kelas_id=b.id
                WHERE a.kelas_id='" . $kelas_id . "'";
        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function getdata_kelas_id_all()
    {
        $SQL = "SELECT
                b.kelas as kelas,
                a.*
                FROM info_spp a LEFT JOIN kelas b
                ON a.kelas_id=b.id";
        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function updatedataspp()
    {
        $id = $this->payload['id'];
        $iuran = $this->payload['iuran'];
        $denda = $this->payload['denda'];

        $data = [
            'iuran' => $iuran,
            'denda' => $denda,
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now,
        ];

        $query = $this->db->where('id', $id)->update('info_spp', $data);
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
}
