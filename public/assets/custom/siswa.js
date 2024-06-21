function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('MasterSiswa', ['datatables']);
app.controller('MasterSiswaController', function ($scope, $http) {
    $scope.LoadDataSiswa = function () {
        $http.get(base_url('adm/siswa/getdata'))
            .then(function (response) {
                $scope.LoadData = response.data;
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    };
    $scope.LoadDataSiswa();
    $scope.CMBKelas = function () {
        $http.get(base_url('adm/kelas/getdata'))
            .then(function (response) {
                var optionsData = response.data;
                $scope.kelasOptions = optionsData;
            })
            .catch(function (error) {
                console.error(error);
            });
    }
    $scope.CMBKelas();
    $scope.CMBGolongan = function () {
        $http.get(base_url('adm/golongan/getdata'))
            .then(function (response) {
                var optionsData = response.data;
                $scope.GolonganOptions = optionsData;
            })
            .catch(function (error) {
                console.error(error);
            });
    }

    $scope.CMBGolongan();
    $scope.AddSiswa = function () {
        $("#my-modal").modal("show");
    }

    $scope.SimpanSiswa = function () {
        var kelas = $scope.cmb_kelas;
        var nisn = $scope.nisn;
        var nama = $scope.nama;
        var jk = $scope.cmb_jk;
        var ortua_pr = $scope.ortu_perempuan;
        var ortua_lk = $scope.ortu_laki;
        var no_hp = $scope.no_hp;

        var selectedValue = $scope.cmb_kelas;
        var selectedText = "";
        var selectedOption = $scope.kelasOptions.find(function (option) {
            return option.id === selectedValue;
        });
        if (selectedOption) {
            selectedText = selectedOption.kelas;
        }

        var cmb_golongan = document.getElementById("cmb_golongan");
        var cmb_golongan_value = cmb_golongan.options[cmb_golongan.selectedIndex].value;

        if (kelas === undefined || nisn === undefined || jk === undefined || nama === undefined || ortua_pr === undefined || ortua_lk === undefined || no_hp === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Field Yang Tersedia !'
            });
        } else {
            var formdata = {
                kelas_id: selectedValue,
                nisn: nisn,
                nama: nama,
                jk: jk,
                ortu_laki: ortua_lk,
                ortu_perempuan: ortua_pr,
                no_hp: no_hp,
                golongan:cmb_golongan_value,
            };
            $http.post(base_url('adm/siswa/insert'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        $scope.LoadDataSiswa();
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

    $scope.SiswaShow = function (dt) {
        $scope.dt = angular.copy(dt);
        $("#id_update").val($scope.dt.id);
        $("#cmb_kelas_update").val($scope.dt.kelas_id);
        $("#nisn_update").val($scope.dt.nisn);
        $("#nama_update").val($scope.dt.nama);
        $("#cmb_jk_update").val($scope.dt.jk);
        $("#ortu_perempuan_update").val($scope.dt.ortu_perempuan);
        $("#ortu_laki_update").val($scope.dt.ortu_laki);
        $("#no_hp_update").val($scope.dt.no_hp);
        $("#cmb_golongan_update").val($scope.dt.golongan_id);
        $("#my-modal-edit").modal("show");
    }

    $scope.UpdateDataSiswa = function () {
        var id = $("#id_update").val();
        var kelas_id = $("#cmb_kelas_update").val();
        var nisn = $("#nisn_update").val();
        var nama = $("#nama_update").val();
        var jk = $("#cmb_jk_update").val();
        var ortu_pr = $("#ortu_perempuan_update").val();
        var ortu_lk = $("#ortu_laki_update").val();
        var no_hp = $("#no_hp_update").val();
        var golongan = $("#cmb_golongan_update").val();

        var formdata = {
            id: id,
            kelas_id: kelas_id,
            nisn: nisn,
            nama: nama,
            jk: jk,
            ortu_laki: ortu_lk,
            ortu_perempuan: ortu_pr,
            no_hp: no_hp,
            golongan:golongan,
        }
        $http.post(base_url('adm/siswa/update'), formdata)
            .then(function (response) {
                var data = response.data;
                if (data.status === "success") {
                    $scope.LoadDataSiswa();
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

    $scope.SiswaDelete = function (dt) {
        $scope.dt = angular.copy(dt);
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data Siswa Dengan Nama ' + $scope.dt.nama + ' dan NISN ' + $scope.dt.nisn + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $http.delete(base_url('adm/siswa/delete/' + $scope.dt.id))
                    .then(function (response) {
                        $scope.LoadDataSiswa();
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

    $scope.ImportSiswa = function () {
        $("#my-modal-import").modal("show");
    }

    $scope.ImportDataSiswa = function () {
        var form = document.getElementById("form_insert_siswa")
        var formData = new FormData(form);
        fetch(base_url('adm/siswa/import'), {
            method: 'POST',
            body: formData
        }).then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    $scope.LoadDataSiswa();
                    $("#my-modal-import").modal('toggle');
                    Swal.fire({
                        icon: 'success',
                        title: 'Good Luck',
                        text: 'Data Berhasil Disimpan !'
                    });
                }
            })
            .catch(error => {
                console.error(error);
            })
    }

    $scope.AktivasiAkunSiswa = function (dt) {
        if (dt.status_akun === 'Non Active') {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda ingin mengaktivasi akun dengan data Siswa Dengan Nama ' + dt.nama + ' dan NISN ' + dt.nisn + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktivasi',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = {
                        nisn: dt.nisn,
                        id: dt.id,
                        nama: dt.nama,
                    };
                    $http.post(base_url('adm/siswa/aktivasi_akun'), formdata)
                        .then(function (response) {
                            var data = response.data;
                            if (data.status === "success") {
                                $scope.LoadDataSiswa();
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
                text: 'Aktivasi dengan Akun ' + dt.nisn + ' dengan nama ' + dt.nama + ' Sudah Teraktivasi !'
            });
        }
    }


    $scope.AktivasiTransaksiSiswa = function (dt) {
        if (dt.status_transaksi === 'Non Active') {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda ingin mengaktivasi Data Transaksi dengan data Siswa Dengan Nama ' + dt.nama + ' dan NISN ' + dt.nisn + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktivasi',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = {
                        nisn: dt.nisn,
                        id: dt.id,
                        nama: dt.nama,
                    };
                    $http.post(base_url('adm/siswa/aktivasi_transaksi'), formdata)
                        .then(function (response) {
                            var data = response.data;
                            if (data.status === "success") {
                                $scope.LoadDataSiswa();
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
                text: 'Aktivasi Transaksi dengan Akun ' + dt.nisn + ' dengan nama ' + dt.nama + ' Sudah Teraktivasi !'
            });
        }
    }

    $scope.PasswordLoad = [];
    $scope.ShowPassword = function (dt) {
        var formdata = {
            nisn: dt.nisn,
        };
        $http.post(base_url('adm/siswa/show_password'), formdata)
            .then(function (response) {
                $scope.PasswordLoad = response.data;
                $("#my-modal-password").modal('show');
            }).catch(function (error) {
                console.error('Terjadi kesalahan saat menyimpan data:', error);
            });
    }


});