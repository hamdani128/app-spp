<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function getdatasiswa()
    {
        $username = $this->session->userdata('username');
        $row = $this->db->where('nisn', $username)->get('siswa')->row();
        $transaksi = $this->db->where('siswa_id', $row->id)->where('status_bayar', 'Non Payment')->get('transaksi_spp')->result();
        $data = [
            'row' => $row,
            'transaksi' => $transaksi
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
            $data = [
                'file_img' => $uploader['upload_data']['file_name'],
                ''
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
    }
}