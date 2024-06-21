function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('MasterGolongan', ['datatables']);
app.controller('MasterGolonganController', function ($scope, $http) {
    function LoadDataGolongan() {
        $http.get(base_url('adm/golongan/getdata'))
            .then(function (response) {
                $scope.LoadData = response.data;
                // console.log(response.data);
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    }
    LoadDataGolongan();

    $scope.Add = function () {
        $("#my-modal").modal('show');
    }

    $scope.ShowEdit = function (dt) {
        $scope.data = angular.copy(dt);
        $("#id_update").val($scope.data.id);
        $("#golongan_update").val($scope.data.golongan);
        $("#jumlah_update").val($scope.data.jumlah);
        $("#my-modal-edit").modal('show');
    }

    $scope.SimpanGolongan = function () {

        var golongan = $("#golongan").val();
        var jumlah = $("#jumlah").val();
        if (golongan === undefined || jumlah === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Field Tersedia !'
            });
        } else {
            var formdata = {
                golongan: golongan,
                jumlah : jumlah,
            };
            $http.post(base_url('adm/golongan/insert'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        LoadDataGolongan();
                        $("#my-modal").modal('toggle');
                        Swal.fire({
                            icon: 'success',
                            title: 'Good Luck',
                            text: 'Data Berhasil Disimpan !'
                        });
                    }
                }).catch(function (error) {
                    console.error('Terjadi kesalahan saat menyimpan data:', error);
                });
        }
    }

    $scope.UpdateGolongan = function () {
        var formdata = {
            id: $("#id_update").val(),
            golongan: $("#golongan_update").val(),
            jumlah: $("#jumlah_update").val(),
        };
        $http.post(base_url('adm/golongan/update'), formdata)
            .then(function (response) {
                var data = response.data;
                if (data.status === "success") {
                    LoadDataGolongan();
                    $("#my-modal-edit").modal('toggle');
                    Swal.fire({
                        icon: 'success',
                        title: 'Good Luck',
                        text: 'Data Berhasil Diubah !'
                    });
                }
            }).catch(function (error) {
                console.error('Terjadi kesalahan saat menyimpan data:', error);
            });
    }

    $scope.Delete = function (dt) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data Golongan ' + dt.golongan + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $http.delete(base_url('adm/golongan/delete/' + dt.id))
                    .then(function (response) {
                        // Handler ketika permintaan berhasil
                        // Tampilkan SweetAlert sukses
                        LoadDataGolongan();
                        Swal.fire({
                            icon: 'success',
                            title: 'Good Luck',
                            text: 'Data Berhasil Dihapus!'
                        });

                    })
                    .catch(function (error) {
                        // Handler ketika terjadi kesalahan pada permintaan
                        console.error('Terjadi kesalahan saat menghapus data meja', error);
                        // Tampilkan SweetAlert error
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menghapus data meja!'
                        });
                        // Lakukan penanganan kesalahan yang sesuai
                        // ...
                    });
            }
        });
    }

});