<?php
class M_transaksi extends CI_Model
{

    public function data_siswa_bytransaksi($id_transaksi)
    {
        $id_siswa = $this->db->where('id', $id_transaksi)->get('transaksi_spp')->row()->siswa_id;
        $SQL = "SELECT
                a.nisn as nisn,
                a.nama as nama,
                a.jk as jk,
                b.kelas as kelas
                FROM siswa a
                LEFT JOIN kelas b ON a.kelas_id = b.id
                WHERE a.id ='" . $id_siswa . "'";

        $row = $this->db->query($SQL)->row();
        return $row;
    }

    public function upload_image_to_server($file_sumber, $nama_file)
    {
        $remote_path = '/public_html/npn-network.id/public/upload/' . $nama_file; // Path file di server eksternal
        // Konfigurasi FTP
        $ftp_server = 'smkn7medan.sch.id'; // Ganti dengan alamat FTP server Anda
        $ftp_user = 'riski@smkn7medan.sch.id'; // Ganti dengan username FTP Anda
        $ftp_pass = '#netindo2023'; // Ganti dengan password FTP Anda

        // Membuat koneksi FTP
        $conn_id = ftp_connect($ftp_server);

        // Login ke FTP server
        $login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);

        // Cek apakah login berhasil
        if ($login_result) {
            // Aktifkan mode pasif FTP
            ftp_pasv($conn_id, true);
            // Mengunggah file ke server eksternal
            if (ftp_put($conn_id, $remote_path, $file_sumber, FTP_BINARY)) {
                $pesan = 'success';
            } else {
                $pesan = 'File gagal diunggah ke server eksternal.';
            }
            // Menutup koneksi FTP
            ftp_close($conn_id);
        } else {
            $pesan = 'Gagal melakukan login ke FTP server.';
        }
        return $pesan;
    }




    public function SendWA($number, $message)
    {
        $setting = $this->db->get("settings")->row();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // $phone = "+6281533857572";  // Nomor tujuan
        $apikey = $setting->api_key;   // API Key Anda
        $sender = $setting->number_blast;
        // $message = 'Assalllamualaikum Cinnaayyy' . "\n" . 'This is a new line in the message.';
        // $url = 'http://api.textmebot.com/send.php?recipient=' . $phone . '&apikey=' . $apikey . '&text=' . urlencode($message);
        $url = 'https://wa.srv12.wapanels.com/send-message?api_key=' . $apikey . '&sender=' . $sender . '&number=' . $number . '&message=' . urlencode($message);
        $html = file_get_contents($url);
        // Anda juga bisa mengembalikan respons atau menampilkan sesuai kebutuhan
        if ($html !== false) {
            // Melakukan parsing JSON dari konten yang diterima
            $response = json_decode($html, true);
            // Periksa jika parsing JSON berhasil
            if ($response !== null) {
                $pesan = "success";
            } else {
                $pesan = "Gagal parsing JSON.";
            }
        } else {
            $pesan = "Gagal mengambil konten dari URL.";
        }
    }

    public function sendWAImage($url_image, $caption, $number)
    {
        $setting = $this->db->get("settings")->row();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // $phone = "+6281533857572";  // Nomor tujuan
        $apikey = $setting->api_key;   // API Key Anda
        $sender = $setting->number_blast;
        // $message = 'Assalllamualaikum Cinnaayyy' . "\n" . 'This is a new line in the message.';
        // $url = 'http://api.textmebot.com/send.php?recipient=' . $phone . '&apikey=' . $apikey . '&text=' . urlencode($message);
        $url = 'https://wa.srv12.wapanels.com/send-media?api_key=' . $apikey . '&sender=' . $sender . '&number=' . $number . '&media_type=image&caption=' . urlencode($caption) . '&url=' . $url_image . '';
        $html = file_get_contents($url);
        // Anda juga bisa mengembalikan respons atau menampilkan sesuai kebutuhan
        if ($html !== false) {
            // Melakukan parsing JSON dari konten yang diterima
            $response = json_decode($html, true);
            // Periksa jika parsing JSON berhasil
            if ($response !== null) {
                $pesan = "success";
            } else {
                $pesan = "Gagal parsing JSON.";
            }
        } else {
            $pesan = "Gagal mengambil konten dari URL.";
        }
    }

    public function SendImage2($url_image, $caption, $number)
    {
        $setting = $this->db->get("settings")->row();
        $apikey = $setting->api_key;
        //script php
        //script php
        // $data = [
        //     'api_key' => $apikey,
        //     'sender' => $number,
        //     'number' => $number,
        //     'media_type' => 'image',
        //     'caption' => $caption,
        //     'url' => $url_image,
        // ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://wa.srv12.wapanels.com/send-media",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'api_key=' . $apikey . '&sender=' . $number . '&number=' . $number . '&media_type=image&caption=' . urlencode($caption) . '&url=' . $url_image,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
