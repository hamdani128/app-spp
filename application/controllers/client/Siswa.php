<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    private $payload;
    private $userid;
    private $level;
    private $now;
    private $ModelTransaksi;
    public function __construct()
    {
        parent::__construct();
        $this->payload = json_decode(file_get_contents("php://input"), true);
        $this->userid = $this->session->userdata("user_id");
        $this->now = date("Y-m-d H:i:s");
        $this->level = $this->session->userdata('level');
        $this->load->model('M_transaksi');
    }


    public function getdatasiswa()
    {
        $username = $this->session->userdata('username');
        $row = $this->db->where('nisn', $username)->get('siswa')->row();
        $transaksi1 = $this->db->where('siswa_id', $row->id)->where('status_bayar', 'Non Payment')->get('transaksi_spp')->result();
        $transaksi2 = $this->db->where('siswa_id', $row->id)->where('status_bayar', 'Menunggu Validasi')->get('transaksi_spp')->result();
        $transaksi3 = $this->db->where('siswa_id', $row->id)->where('status_bayar', 'Payment')->get('transaksi_spp')->result();
        $data = [
            'row' => $row,
            'transaksi' => $transaksi1,
            'transaksi_menunggu' => $transaksi2,
            'payment' => $transaksi3,
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function detail_siswa()
    {
        $payload = json_decode(file_get_contents('php://input'), true);
        $transaksi = $this->db->where('id', $payload['id'])->get('transaksi_spp')->row();
        $siswa = $this->db->where('id', $transaksi->siswa_id)->get('siswa')->row();
        $kelas = $this->db->where('id', $siswa->kelas_id)->get('kelas')->row();
        $data = [
            'nisn' => $siswa->nisn,
            'nama' => $siswa->nama,
            'kelas' => $kelas->kelas,
            'periode' => $transaksi->bulan,
            'semester' => $transaksi->semester,
            'iuran' => $transaksi->iuran,
        ];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function pembayaran()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->input->post('id_update');
        $row_transaksi = $this->db->where('id', $id)->get('transaksi_spp')->row();
        $fileImages = $_FILES['files'];
        $new_name = time() . "-" . date('Ymd');
        $config['upload_path'] = FCPATH . 'public/upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']            = 10240;
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('files')) {
            $error = array('error' => $this->upload->display_errors());
            $response = array(
                'status' => 'img_error',
                'message' => $error,
            );
        } else {
            $uploader = array('upload_data' => $this->upload->data());
            $invoice = "INV" . date('YmdHis') . random_int(100, 999);
            $fileName = $uploader['upload_data']['file_name'];
            $sumberFileLocal = FCPATH . 'public/upload/' . $fileName;
            $sumber_file_server = "https://npn-network.id/public/upload/" . $fileName;
            $this->M_transaksi->upload_image_to_server($sumberFileLocal, $fileName);
            $row_siswa = $this->M_transaksi->data_siswa_bytransaksi($id);
            $message = 'Informasi Pembayaran' . "\n" .
                '======================' . "\n" .
                'No.Invoice :' . $invoice . "\n" .
                'NISN : ' . $row_siswa->nisn . "\n" .
                'Nama : ' . $row_siswa->nama . "\n" .
                'Kelas : ' . $row_siswa->kelas . "\n" .
                'periode : ' . $row_transaksi->bulan . "\n" .
                'Jumlah Dibayar : ' .  $this->input->post('jumlah_dibayar') . "\n" .
                'Meode Bayar : ' .  $this->input->post('channel_bayar') . "\n";
            // echo $message;
            $this->M_transaksi->sendWAImage($sumber_file_server,  $message, "6281533857572");
            $data = [
                'file_image' => $uploader['upload_data']['file_name'],
                'no_invoice' => $invoice,
                'jumlah_dibayar' => $this->input->post('jumlah_dibayar'),
                'denda' => '0',
                'tgl_bayar' => date('Y-m-d'),
                'status_bayar' => 'Menunggu Validasi',
                'channel' => $this->input->post('channel_bayar'),
                'kode_ref' => $this->input->post('kode_ref_channel'),
                'metode_bayar' => 'Third Party',
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $query = $this->db->where('id', $id)->update('transaksi_spp', $data);
            if ($query) {
                $response = [
                    'status' => 'success',
                    'message' => 'Transaksi Berhasil Disimpan',
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Transaks Tidak berhasil',
                ];
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function sendwa_image()
    {
        $caption = 'Assalllamualaikum' . "\n" .
            'Ada Pembayaran niihh.';
        $number = '6281533857572';
        $imageurl = 'http://npn-network.id/public/land/img/logo.png';
        $response = $this->M_transaksi->sendWAImage($imageurl, $caption, $number);
        if ($response !== null) {
            // Anda sekarang memiliki data JSON dalam bentuk array atau objek
            // Lakukan apa yang perlu Anda lakukan dengan data ini
            var_dump($response);
        } else {
            echo "Gagal parsing JSON.";
        }
    }

    public function sendwa()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // $phone = "+6281533857572";  // Nomor tujuan
        $apikey = "HakdlsMz2PqqbWCaAADxZ3CIlyVfv4";   // API Key Anda
        $message = 'Assalllamualaikum Cinnaayyy' . "\n" . 'This is a new line in the message.';
        // $url = 'http://api.textmebot.com/send.php?recipient=' . $phone . '&apikey=' . $apikey . '&text=' . urlencode($message);
        $url = 'https://wa.srv12.wapanels.com/send-message?api_key=' . $apikey . '&sender=6281375078785&number=6281533857572&message=' . urlencode($message);
        $html = file_get_contents($url);
        // Anda juga bisa mengembalikan respons atau menampilkan sesuai kebutuhan
        if ($html !== false) {
            // Melakukan parsing JSON dari konten yang diterima
            $response = json_decode($html, true);
            // Periksa jika parsing JSON berhasil
            if ($response !== null) {
                // Anda sekarang memiliki data JSON dalam bentuk array atau objek
                // Lakukan apa yang perlu Anda lakukan dengan data ini
                var_dump($response);
            } else {
                echo "Gagal parsing JSON.";
            }
        } else {
            echo "Gagal mengambil konten dari URL.";
        }
    }
}
