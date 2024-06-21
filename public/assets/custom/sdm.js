function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('MasterSDM', ['datatables']);
app.controller('MasterSDMController', function ($scope, $http) {
    function LoadDataSDM() {
        $http.get(base_url('adm/users/getdata'))
            .then(function (response) {
                $scope.LoadData = response.data;
                // console.log(response.data);
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    }
    LoadDataSDM();

    $scope.Add = function () {
        $("#my-modal").modal('show');
    }

    $scope.ShowEdit = function (dt) {
        $scope.data = angular.copy(dt);
        $("#id_update").val($scope.data.id);
        $("#fullname_update").val($scope.data.fullname);
        $("#cmb_jk_update").val($scope.data.jenis_kelamin);
        $("#jabatan_update").val($scope.data.jabatan);
        $("#my-modal-edit").modal('show');
    }

    $scope.SimpanSDM = function () {
        var fullname = $("#fullname").val();
        var cmb_jk = $("#cmb_jk").val();
        var jabatan = $("#jabatan").val();

        if (fullname === undefined || cmb_jk === undefined || jabatan === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Field Tersedia !'
            });
        } else {
            var formdata = {
                fullname: fullname,
                jk : cmb_jk,
                jabatan: jabatan,
            };

            $http.post(base_url('adm/users/insert'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        LoadDataSDM();
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

    $scope.UpdateSDM = function () {
        var fullname = $("#fullname_update").val();
        var cmb_jk = $("#cmb_jk_update").val();
        var jabatan = $("#jabatan_update").val();
        var formdata = {
            id: $("#id_update").val(),
            fullname: fullname,
            jk : cmb_jk,
            jabatan: jabatan,
        };
        $http.post(base_url('adm/users/update'), formdata)
            .then(function (response) {
                var data = response.data;
                if (data.status === "success") {
                    LoadDataSDM();
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
            text: 'Anda yakin ingin menghapus data SDM ' + dt.fullname + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $http.delete(base_url('adm/users/delete/' + dt.id))
                    .then(function (response) {
                        // Handler ketika permintaan berhasil
                        // Tampilkan SweetAlert sukses
                        LoadDataSDM();
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

    $scope.ActivasiAccount = function (dt) {
        if (dt.status === 'Non Active') {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda ingin mengaktivasi akun dengan data SDM Dengan Nama ' + dt.fullname + ' dan Kode ' + dt.kode + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktivasi',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = {
                        id : dt.id,
                        kode: dt.kode,
                        fullname: dt.fullname,
                    };
                    $http.post(base_url('adm/users/aktivasi_akun'), formdata)
                        .then(function (response) {
                            var data = response.data;
                            if (data.status === "success") {
                                $scope.LoadDataSDM();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Good Luck',
                                    text: 'Data Aktivasi Berhasil Diaktifkan !'
                                });
                            }
                        }).catch(function (error) {
                            console.error('Terjadi kesalahan saat menyimpan data:', error);
                        });
                }
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Notifications',
                text: 'Aktivasi dengan Akun Fullname ' + dt.fullname + ' dengan kode ' + dt.kode + ' Sudah Teraktivasi !'
            });
        }
    }

});