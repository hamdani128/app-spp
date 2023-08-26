function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}


var app = angular.module('TransaksiApp', ['datatables']);
app.controller('TransaksiAppController', function ($scope, $http) {
    $scope.Transaksi = [];
    $scope.CekDataSiswa = function () {
        var nisn = $scope.nisn;
        if (nisn === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Field NISN Siswa !'
            });
        } else {
            var formdata = {
                nisn: nisn,
            };
            $http.post(base_url('adm/transaksi/getdata_transaksi'), formdata)
                .then(function (response) {
                    var optionsData = response.data.list;
                    $scope.Transaksi = optionsData;
                    var nisn = response.data.nisn;
                    var kelas = response.data.kelas;
                    var jk = response.data.jk;
                    var nama = response.data.nama;
                    document.getElementById("nisn_list").innerHTML = nisn;
                    document.getElementById("nama_list").innerHTML = nama;
                    document.getElementById("kelas_list").innerHTML = kelas;
                    document.getElementById("jk_list").innerHTML = jk;
                }).catch(function (error) {
                    console.error('Terjadi kesalahan saat menyimpan data:', error);
                });
        }
    }

    $scope.LakukanPembayaran = function (dt) {
        $scope.data = angular.copy(dt);
        if ($scope.data.status_bayar === 'Payment') {
            Swal.fire({
                icon: 'info',
                title: 'Mohon Diperhatikan !',
                text: 'Pembayaran ini Sudah Dilakukan !'
            });
        } else {
            $("#id_update").val($scope.data.id);
            $("#nisn_bayar").val($scope.data.nisn);
            $("#nama_bayar").val($scope.data.nama);
            $("#kelas_bayar").val($scope.data.kelas);
            $("#periode_bayar").val($scope.data.bulan);
            $("#semester_bayar").val($scope.data.semester);
            $("#my-modal").modal("show");
        }
    }

    $scope.SimpanDataPembayaran = function () {
        var id = $("#id_update").val();
        var jumlah_dibayar = $("#jumlah_dibayar").val();
        var denda = $("#denda_dibayar").val();
        if (jumlah_dibayar === "" || denda === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Jumlah Dibayar dan Denda !'
            });
        } else {
            var formdata = {
                id: id,
                jumlah_dibayar: jumlah_dibayar,
                denda: denda,
            };
            $http.post(base_url('adm/transaksi/pembayaran'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        $("#my-modal").modal('toggle');
                        Swal.fire({
                            icon: 'success',
                            title: 'Good Luck',
                            text: 'Pembayaran Berhasil Disimpan !'
                        });
                    }
                }).catch(function (error) {
                    console.error('Terjadi kesalahan saat menyimpan data:', error);
                });
        }
    }


});

