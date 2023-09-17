function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('SiswaTransaksiApp', []);
app.controller('SiswaTransaksiAppController', function ($scope, $http) {
    $scope.PeriodeData = [];
    $scope.KelasData = [];
    $scope.DataTransaksi = [];
    $scope.getDataPeriode = function () {
        $http.get(base_url('adm/transaksi/getdata_periode'))
            .then(function (response) {
                var optionsData = response.data;
                $scope.PeriodeData = optionsData;
            })
            .catch(function (error) {
                console.error(error);
            });
    }

    $scope.getDataPeriode();

    $scope.getDataKelas = function () {
        $http.get(base_url('adm/transaksi/getdata_kelas'))
            .then(function (response) {
                var optionsData = response.data;
                $scope.KelasData = optionsData;
            })
            .catch(function (error) {
                console.error(error);
            });
    }
    $scope.getDataKelas();


    $scope.FilterDataSiswaTransaksi = function () {
        var periode = $("#cmb_periode").val();
        var kelas = $("#cmb_kelas").val();

        if (periode == "" || kelas == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Filter yang tersedia !'
            });
        } else {
            var formdata = {
                periode: periode,
                kelas: kelas,
            };
            $http.post(base_url('adm/transaksi/getdata_transaksi_siswa'), formdata)
                .then(function (response) {
                    var optionsData = response.data;
                    $scope.DataTransaksi = optionsData;
                }).catch(function (error) {
                    console.error('Terjadi kesalahan saat menyimpan data:', error);
                });
        }
    }
    $scope.selectedItems = [];
    $scope.RemindMessage = function () {
        var dataTerpilih = [];
        angular.forEach($scope.DataTransaksi, function (dt) {
            if ($scope.selectedItems[dt.id]) {
                // Checkbox terpilih, tambahkan ke data terpilih
                dataTerpilih.push(dt);
            }
        });
        // Lakukan apa yang Anda inginkan dengan dataTerpilih
        console.log(dataTerpilih);
    }

});