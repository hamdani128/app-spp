function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('MasterSpp', ['datatables']);
app.controller('MasterSppController', function ($scope, $http) {
    $scope.cmb_kelas = ""; // Nilai awal cmb_kelas
    $scope.LoadData = [];
    $scope.CMB_Kelas = function () {
        $http.get(base_url('adm/kelas/getdata'))
            .then(function (response) {
                var optionsData = response.data;
                $scope.kelasOptions = optionsData;
            })
            .catch(function (error) {
                console.error(error);
            });
    };

    $scope.CMB_Kelas_Add = function () {
        $http.get(base_url('adm/kelas/getdata'))
            .then(function (response) {
                var optionsData = response.data;
                $scope.kelasOptionsAdd = optionsData;
            })
            .catch(function (error) {
                console.error(error);
            });
    };

    $scope.CMB_Kelas(); // Panggil fungsi saat kontroller diinisialisasi
    $scope.CMB_Kelas_Add(); // Panggil fungsi saat kontroller diinisialisasi

    $scope.LoadDataKelasAll = function () {
        $http.get(base_url('adm/spp/getdata_kelas_id_all'))
            .then(function (response) {
                $scope.LoadData = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    }
    $scope.LoadDataKelasAll();

    $scope.CekDataKelas = function () {
        var selectedValue = $scope.cmb_kelas;
        var selectedText = "";
        var selectedOption = $scope.kelasOptions.find(function (option) {
            return option.id === selectedValue;
        });
        if (selectedOption) {
            selectedText = selectedOption.kelas;
        }
        $http.get(base_url('adm/spp/getdata_kelas_id/' + selectedValue))
            .then(function (response) {
                $scope.LoadData = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    };

    $scope.AddSpp = function () {
        $("#my-modal").modal("show");
    }

    $scope.SimpanDataSpp = function () {
        var selectedValue = $scope.cmb_kelas_add;
        var selectedText = "";
        var selectedOption = $scope.kelasOptionsAdd.find(function (option) {
            return option.id === selectedValue;
        });
        if (selectedOption) {
            selectedText = selectedOption.kelas;
        }

        if (selectedValue === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Kelas Yang Tersedia !'
            });
        } else {
            var table = document.getElementById('sppTable');
            var rowCount = table.rows.length;
            var data = [];
            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                var bulan = row.cells[1].innerHTML;
                var semester = row.cells[2].querySelector('select[name="cmb_semester"]').value;
                var iuran = row.cells[3].querySelector('input[name="iuran"]').value;
                var denda = row.cells[4].querySelector('input[name="denda"]').value;

                var rowData = {
                    kelas_id: selectedValue,
                    kelas: selectedText,
                    bulan: bulan,
                    semester: semester,
                    iuran: iuran,
                    denda: denda
                };
                data.push(rowData);
            }
            var formdata = {
                data: data,
            };
            $http.post(base_url('adm/spp/insert'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        // LoadDataKelas();
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

    $scope.InfoSppShow = function (dt) {
        $scope.data = angular.copy(dt)
        $("#id_update").val($scope.data.id);
        $scope.kelas = $scope.data.kelas;
        $scope.bulan = $scope.data.bulan;
        $("#jumlah_iuran_update").val($scope.data.iuran);
        $("#denda_iuran_update").val($scope.data.denda);
        $("#my-modal-edit").modal("show");
    }

    $scope.UpdateDataSpp = function () {
        var formdata = {
            id: $("#id_update").val(),
            iuran: $("#jumlah_iuran_update").val(),
            denda: $("#denda_iuran_update").val(),
        };
        $http.post(base_url('adm/spp/updatedataspp'), formdata)
            .then(function (response) {
                var data = response.data;
                if (data.status === "success") {
                    $("#my-modal-edit").modal('toggle');
                    $scope.LoadDataKelasAll();
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

});
