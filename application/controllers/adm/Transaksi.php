<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    private $payload;
    private $userid;
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
        date_default_timezone_set('Asia/Jakarta');
        $this->payload = json_decode(file_get_contents("php://input"), true);
        $this->userid = $this->session->userdata("user_id");
        $this->now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [
            'content' => 'pages/transaksi/transaksi',
        ];
        $this->load->view('layout/index', $data);
    }

    public function siswa()
    {
        $data = [
            'content' => 'pages/transaksi/siswa',
        ];
        $this->load->view('layout/index', $data);
    }

    public function getdata_periode()
    {
        $query = $this->db->select("bulan")->from('info_spp')->group_by("bulan")->get()->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function getdata_kelas()
    {
        $query = $this->db->select("kelas")->from('kelas')->group_by("kelas")->get()->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function getdata_transaksi_siswa()
    {
        $periode = $this->payload['periode'];
        $kelas = $this->payload['kelas'];
        $SQL = "SELECT 
                a.id as id,
                a.no_invoice as no_invoice,
                b.nisn as nisn,
                b.nama as nama,
                b.kelas as kelas,
                a.bulan as bulan,
                a.semester as semester,
                a.iuran as iuran,
                a.jumlah_dibayar as jumlah_dibayar,
                a.denda as denda,
                a.status_bayar as status_bayar,
                a.updated_at as updated_at
                FROM transaksi_spp a 
                LEFT JOIN (
                SELECT
                a.id as id, 
                a.nisn as nisn,
                a.nama as nama,
                b.kelas as kelas
                FROM
                siswa a
                LEFT JOIN kelas b ON a.kelas_id = b.id
                ) b ON a.siswa_id = b.id
                WHERE a.bulan='" . $periode . "' AND b.kelas='" . $kelas  . "'";

        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function getdata_transaksi()
    {
        $nisn = $this->payload['nisn'];
        $SQL1 = "SELECT 
                a.id as id,
                a.no_invoice as no_invoice,
                b.nisn as nisn,
                b.nama as nama,
                b.kelas as kelas,
                a.bulan as bulan,
                a.semester as semester,
                a.iuran as iuran,
                a.jumlah_dibayar as jumlah_dibayar,
                a.denda as denda,
                a.status_bayar as status_bayar
                FROM transaksi_spp a 
                LEFT JOIN (
                SELECT
                a.id as id, 
                a.nisn as nisn,
                a.nama as nama,
                b.kelas as kelas
                FROM
                siswa a
                LEFT JOIN kelas b ON a.kelas_id = b.id
                ) b ON a.siswa_id = b.id
                WHERE b.nisn='" . $nisn . "' 
                AND a.status_bayar = 'Non Payment'";
        $query1 = $this->db->query($SQL1)->result();
        $SQL2 = "SELECT
                a.nisn as nisn,
                a.nama as nama,
                b.kelas as kelas,
                a.jk as jk
                FROM siswa a 
                LEFT JOIN kelas b ON a.kelas_id = b.id
                WHERE a.nisn='" . $nisn . "'";
        $query2 = $this->db->query($SQL2)->row();
        $data = [
            'nisn' => $query2->nisn,
            'nama' => $query2->nama,
            'kelas' => $query2->kelas,
            'jk' => $query2->jk,
            'list' => $query1,
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function gettransaksi_validasi()
    {
        $SQL = "SELECT
                a.id as id,
                b.kelas as kelas,
                b.nisn as nisn,
                b.nama as nama,
                b.jk as jk,
                b.ortu_laki as ortu_laki,
                b.ortu_perempuan as ortu_perempuan,
                b.no_hp as no_hp,
                a.no_invoice as no_invoice,
                a.bulan as bulan,
                a.semester as semester,
                a.iuran as iuran,
                a.jumlah_dibayar as jumlah_dibayar,
                a.denda as denda,
                a.tgl_bayar as tgl_bayar,
                a.status_bayar as status_bayar,
                a.metode_bayar as metode_bayar,
                a.channel as channel,
                a.kode_ref as kode_ref,
                a.user_id as user_id,
                a.file_image as file_image,
                a.created_at as created_at,
                a.updated_at as updated_at
                FROM 
                transaksi_spp a 
                LEFT JOIN (
                    SELECT
                    a.id as id, 
                    b.kelas as kelas,
                    a.nisn as nisn,
                    a.nama as nama,
                    a.jk as jk,
                    a.ortu_laki as ortu_laki,
                    a.ortu_perempuan as ortu_perempuan,
                    a.no_hp as no_hp
                    FROM siswa a 
                    LEFT JOIN kelas b ON a.kelas_id = b.id
                ) b ON a.siswa_id = b.id
                WHERE a.status_bayar='Menunggu Validasi'
        ";
        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }


    public function pembayaran()
    {
        $id = $this->payload['id'];
        $jumlah_dibayar = $this->payload['jumlah_dibayar'];
        $denda = $this->payload['denda'];
        $invoice = "INV" . date('YmdHis') . random_int(100, 999);
        $tgl_bayar = date('Y-m-d');
        $status_bayar = 'Payment';
        $metode_bayar = 'Langsung';
        $update_at = $this->now;

        $data = [
            'no_invoice' => $invoice,
            'jumlah_dibayar' => $jumlah_dibayar,
            'denda' => $denda,
            'tgl_bayar' => $tgl_bayar,
            'status_bayar' => $status_bayar,
            'metode_bayar' => $metode_bayar,
            'updated_at' => $update_at,
        ];

        $query = $this->db->where('id', $id)->update('transaksi_spp', $data);
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Payment',
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


    public function riwayat()
    {
        $data = [
            'content' => 'pages/transaksi/riwayat',
        ];
        $this->load->view('layout/index', $data);
    }

    public function getriwayat_transaksi()
    {
        $SQL = "SELECT 
                a.id as id,
                a.no_invoice as no_invoice,
                b.nisn as nisn,
                b.nama as nama,
                b.kelas as kelas,
                a.bulan as bulan,
                a.semester as semester,
                a.iuran as iuran,
                a.jumlah_dibayar as jumlah_dibayar,
                a.denda as denda,
                a.status_bayar as status_bayar,
                a.updated_at as updated_at
                FROM transaksi_spp a 
                LEFT JOIN (
                SELECT
                a.id as id, 
                a.nisn as nisn,
                a.nama as nama,
                b.kelas as kelas
                FROM
                siswa a
                LEFT JOIN kelas b ON a.kelas_id = b.id
                ) b ON a.siswa_id = b.id
                WHERE a.no_invoice NOT IN ('')";
        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function getriwayat_transaksi_filter()
    {
        $tanggal = $this->input->get('tanggal');
        $SQL = "SELECT 
                a.id as id,
                a.no_invoice as no_invoice,
                b.nisn as nisn,
                b.nama as nama,
                b.kelas as kelas,
                a.bulan as bulan,
                a.semester as semester,
                a.iuran as iuran,
                a.jumlah_dibayar as jumlah_dibayar,
                a.denda as denda,
                a.status_bayar as status_bayar,
                a.updated_at as updated_at
                FROM transaksi_spp a 
                LEFT JOIN (
                SELECT
                a.id as id, 
                a.nisn as nisn,
                a.nama as nama,
                b.kelas as kelas
                FROM
                siswa a
                LEFT JOIN kelas b ON a.kelas_id = b.id
                ) b ON a.siswa_id = b.id
                WHERE a.no_invoice NOT IN ('')
                AND a.tgl_bayar='" . $tanggal . "'";
        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }


    public function validasi_pembayaran()
    {
        $id = $this->payload['id'];
        $data = [
            'status_bayar' => 'Payment',
            'user_id' => $this->userid,
            'updated_at' => $this->now,
        ];
        $query = $this->db->where('id', $id)->update("transaksi_spp", $data);

        if ($query) {
            $response = [
                'status' => 'success',
                'message' => 'Success Validasi',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error Validasi',
            ];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
