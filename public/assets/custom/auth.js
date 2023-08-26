function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('Auth', []);
app.controller('AuthController', function ($scope, $http) {
    $scope.Login = function () {

        if ($scope.username === undefined || $scope.password === undefined) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Username dan Password !'
            });
        } else {
            var formdata = {
                username: $scope.username,
                password: $scope.password,
            };
            $http.post(base_url('auth/login/cek_login'), formdata)
                .then(function (response) {
                    var data = response.data;
                    if (data.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Authentication Success',
                            text: 'Anda Berhasil Login !'
                        });
                        document.location.href = base_url('home');
                    } else if (data.status === "gagal") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error',
                            text: 'Username dan password salah !'
                        });
                    }
                }).catch(function (error) {
                    console.error('Terjadi kesalahan saat menyimpan data:', error);
                });
        }
    }
});