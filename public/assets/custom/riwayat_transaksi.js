function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('RiwayatTransaksiApp', ['datatables']);
app.controller('RiwayatTransaksiAppController', function ($scope, $http) {
    $scope.LoadDataTransaksiAll = function () {
        $http.get(base_url('adm/transaksi/getriwayat_transaksi'))
            .then(function (response) {
                var LoadData = response.data;
                $scope.Transaksi = LoadData;
            })
            .catch(function (error) {
                console.error(error);
            });
    }
    $scope.LoadDataTransaksiAll();

    $scope.FilterData = function () {
        var tanggal = $("#tanggal_filter").val();
        // Hapus DataTable sebelum pembaruan
        $http.get(base_url('adm/transaksi/getriwayat_transaksi_filter'), {
            params: {
                tanggal: tanggal
            }
        }).then(function (response) {
            var filteredData = response.data;
            var table = $("#tb_riwayat").DataTable();
            if (filteredData.length > 0) {
                table.clear().draw();
                table.destroy();
                $scope.Transaksi = filteredData;
                $("#tb_riwayat").DataTable({
                    data: filteredData,
                    // Konfigurasi kolom-kolom Anda di sini
                });
            } else {
                $scope.Transaksi = filteredData;
                table.clear().draw();
            }
        })
            .catch(function (error) {
                console.error(error);
            });
    }
});