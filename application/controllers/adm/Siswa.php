<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
            'content' => 'pages/master/siswa',
        ];
        $this->load->view('layout/index', $data);
    }


    public function getdata()
    {
        $SQL = "SELECT 
                b.kelas as kelas,
                a.*
                FROM siswa a
                LEFT JOIN kelas b ON a.kelas_id=b.id";
        $query = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function insert()
    {
        $data = [
            'kelas_id' => $this->payload['kelas_id'],
            'nisn' => $this->payload['nisn'],
            'nama' => $this->payload['nama'],
            'jk' => $this->payload['jk'],
            'ortu_laki' => $this->payload['ortu_laki'],
            'ortu_perempuan' => $this->payload['ortu_perempuan'],
            'no_hp' => $this->payload['no_hp'],
            'status_akun' => 'Non Active',
            'status_transaksi' => 'Non Active',
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now
        ];
        $query = $this->db->insert('siswa', $data);
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Inserted'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function update()
    {
        $id = $this->payload['id'];
        $data = [
            'kelas_id' => $this->payload['kelas_id'],
            'nisn' => $this->payload['nisn'],
            'nama' => $this->payload['nama'],
            'jk' => $this->payload['jk'],
            'ortu_laki' => $this->payload['ortu_laki'],
            'ortu_perempuan' => $this->payload['ortu_perempuan'],
            'no_hp' => $this->payload['no_hp'],
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now
        ];
        $query = $this->db->where('id', $id)->update('siswa', $data);
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Inserted'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id)
    {
        $query = $this->db->where('id', $id)->delete('siswa');
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Deleted Siswa'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function download_format()
    {
        $this->load->helper('download');
        // read file contents
        $filename = 'format.xlsx';
        $data = file_get_contents(base_url('/download/' . $filename));
        force_download($filename, $data);
    }

    public function import()
    {
        require_once APPPATH . 'libraries/PHPExcel.php';
        $file = $_FILES['fileberkas'];
        $kela_id = $this->input->post('cmb_kelas_import');
        $objPHPExcel = PHPExcel_IOFactory::load($file['tmp_name']);
        try {
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $totalrow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $totalrow; $row++) {
                    try {
                        $nisn = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $jk = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $no_hp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $orangtua_lk = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $orangtua_perempun = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $data = [
                            'kelas_id' => $kela_id,
                            'nisn' => $nisn,
                            'nama' => $nama,
                            'jk' => $jk,
                            'ortu_laki' => $orangtua_lk,
                            'ortu_perempuan' => $orangtua_perempun,
                            'no_hp' => $no_hp,
                            'status_akun' => 'Non Active',
                            'status_transaksi' => 'Non Active',
                            'user_id' => $this->userid,
                            'created_at' => $this->now,
                            'updated_at' => $this->now
                        ];

                        $query = $this->db->insert('siswa', $data);
                    } catch (Exception $e) {
                        // Tangani error sesuai kebutuhan Anda
                        // Misalnya, Anda bisa mencatat error atau melanjutkan eksekusi loop
                        error_log('Error importing data: ' . $e->getMessage());
                        continue; // Melanjutkan ke iterasi berikutnya
                    }
                }
            }
            if ($query) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Successfully Inserted'
                );
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } catch (Exception $e) {
            echo "Exception caught with message: " . $e->getMessage() . "\n";
        }
    }

    public function aktivasi_akun()
    {
        $nisn = $this->payload['nisn'];
        $id = $this->payload['id'];
        $nama = $this->payload['nama'];

        $passwoord = random_int(100000, 999999);
        $passwoord_hash = md5($passwoord);

        $data1 = array(
            'username' => $nisn,
            'password' => $passwoord,
            'user_id' => $this->userid,
            'created_at' => $this->now,
            'updated_at' => $this->now,
        );

        $data2 = array(
            'fullname' => $nama,
            'username' => $nisn,
            'password' => $passwoord_hash,
            'email' => '-',
            'level' => 'siswa',
            'inititated' => 'siswa',
            'created_at' => $this->now,
            'updated_at' => $this->now,
        );

        $data3 = array(
            'status_akun' => 'Active',
            'user_id' => $this->userid,
            'updated_at' => $this->now,
        );

        $query1 = $this->db->insert('password_history', $data1);
        $query2 = $this->db->insert('users', $data2);
        $query3 = $this->db->where('id', $id)->update('siswa', $data3);
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

    public function aktivasi_transaksi()
    {
        $nisn = $this->payload['nisn'];
        $id = $this->payload['id'];
        $nama = $this->payload['nama'];
        $SQL = "SELECT
                b.id as siswa_id,
                a.bulan as bulan,
                a.semester as semester,
                a.iuran as iuran
                FROM info_spp a
                LEFT JOIN siswa b ON a.kelas_id=b.kelas_id
                WHERE b.nisn='" . $nisn . "'";
        $query = $this->db->query($SQL)->result();
        foreach ($query as $row) {
            $data = [
                'siswa_id' => $row->siswa_id,
                'bulan' => $row->bulan,
                'semester' => $row->semester,
                'iuran' => $row->iuran,
                'status_bayar' => 'Non Payment',
                'user_id' => $this->userid,
                'created_at' => $this->now,
                'updated_at' => $this->now
            ];
            $this->db->insert('transaksi_spp', $data);
        }
        $data2 = array(
            'status_transaksi' => 'Active',
            'updated_at' => $this->now,
        );
        $query2 = $this->db->where('id', $id)->update('siswa', $data2);
        if ($query2) {
            $response = array(
                'status' => 'success',
                'message' => 'Successfully Activated',
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function show_password()
    {
        $nisn = $this->payload['nisn'];
        $SQL = "SELECT * FROM password_history WHERE username='" . $nisn . "'";
        $query  = $this->db->query($SQL)->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }
}
