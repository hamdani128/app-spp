function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('HomeSiswa', ['datatables']);
app.controller('HomeSiswaController', function ($scope, $http) {
    $scope.Transaksi = [];
    $scope.LoadInfoSiswa = function () {
        $http.get(base_url('client/siswa/getdatasiswa'))
            .then(function (response) {
                document.getElementById("nisn_home").innerHTML = response.data.row.nisn;
                document.getElementById("nama_home").innerHTML = response.data.row.nama;
                document.getElementById("kelas_home").innerHTML = response.data.row.kelas;
                document.getElementById("jk_home").innerHTML = response.data.row.jk;
                document.getElementById("orang_tua_home_pr").innerHTML = response.data.row.ortu_perempuan;
                document.getElementById("orang_tua_home_lk").innerHTML = response.data.row.ortu_laki;
                $scope.Transaksi = response.data.transaksi;
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    };

    $scope.LoadInfoSiswa();

    $scope.LakukanPembayaran = function (dt) {
        var formdata = {
            id: dt.id,
        };
        $http.post(base_url('client/siswa/detail_siswa'), formdata)
            .then(function (response) {
                $("#id_update").val(dt.id);
                $("#nisn_bayar").val(response.data.nisn);
                $("#nama_bayar").val(response.data.nama);
                $("#kelas_bayar").val(response.data.kelas);
                $("#periode_bayar").val(response.data.periode);
                $("#semester_bayar").val(response.data.semester);
                $("#iuran_bayar").val(response.data.iuran);
                $("#my-modal").modal("show");
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    }

    $scope.SimpanDataPembayaranClient = function () {
        var nisn_bayar = $("#nisn_bayar").val();
        var nama_bayar = $("#nama_bayar").val();
        var kelas = $("#kelas_bayar").val();
        var periode = $("#periode_bayar").val();
        var semester = $("#semester_bayar").val();
        var jumlah_bayar = $("#jumlah_bayar").val();
        var denda = $("#denda_bayar").val();
        var channel = $("#channel_bayar").val();
        var kode_ref = $("#kode_ref_channel").val();
        var FilesImage = document.getElementById("file-upload").files[0];

        if (nisn_bayar == "" || nama_bayar == "" || kelas == "" || periode == "" || semester == "" || jumlah_bayar == "" || denda == "" || channel === "" || kode_ref == "" || !FilesImage) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Field Yang Tersedia !'
            });
        } else {
            var formupload = document.getElementById("form_pembayaran_client");
            var formData = new FormData(formupload);
            fetch(base_url('client/siswa/pembayaran'), {
                method: 'POST',
                body: formData,
            }).then(response => response.json()).then(data => {
                if (data.status == 'success') {
                    $("#my-modal").modal("toggle");
                    Swal.fire({
                        icon: 'success',
                        title: 'Good Job',
                        text: 'Data Berhasil Disimpan!'
                    });
                    document.location.reload();
                }
            }).catch(error => console.error(error));
        }
    }

});


const fileInput = document.getElementById('file-upload');
const imageContainer = document.getElementById('image-container');

fileInput.addEventListener('change', function (event) {
    // Hapus gambar sebelumnya (jika ada)
    imageContainer.innerHTML = '';

    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const imageFrame = document.createElement('div');
        imageFrame.className = 'image-frame';

        const imageElement = document.createElement('img');
        imageElement.className = 'image-preview';
        imageElement.src = URL.createObjectURL(file);

        imageFrame.appendChild(imageElement);
        imageContainer.appendChild(imageFrame);
    }
})