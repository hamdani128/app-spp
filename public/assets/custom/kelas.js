function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('MasterKelas', ['datatables']);
app.controller('MasterKelasController', function ($scope, $http) {
    function LoadDataKelas() {
        $http.get(base_url('adm/kelas/getdata'))
            .then(function (response) {
                $scope.LoadData = response.data;
                // console.log(response.data);
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    }
    LoadDataKelas();

    $scope.AddKelas = function () {
        $("#my-modal").modal('show');
    }

    $scope.KelasShow = function (dt) {
        $scope.data = angular.copy(dt);
        $("#id_update").val($scope.data.id);
        $scope.kelas_update = $scope.data.kelas;
        $("#my-modal-edit").modal('show');
    }

    $scope.SimpanKelas = function () {
        if ($scope.kelas === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Field Tersedia !'
            });
        } else {
            var formdata = {
                kelas: $scope.kelas,
            };
            $http.post(base_url('adm/kelas/insert'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        LoadDataKelas();
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

    $scope.UpdateKelas = function () {
        var formdata = {
            id: $("#id_update").val(),
            kelas: $scope.kelas_update,
        };
        $http.post(base_url('adm/kelas/update'), formdata)
            .then(function (response) {
                var data = response.data;
                if (data.status === "success") {
                    LoadDataKelas();
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

    $scope.KelasDelete = function (dt) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data kelas ' + dt.kelas + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $http.delete(base_url('adm/kelas/delete/' + dt.id))
                    .then(function (response) {
                        // Handler ketika permintaan berhasil
                        // Tampilkan SweetAlert sukses
                        LoadDataKelas();
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