function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

var app = angular.module('AppSettings', []);
app.controller('AppSettingsController', function ($scope, $http) {
    $scope.check_perubahan = false;
    $scope.getDataApi = function () {
        $http.get(base_url('adm/setting/getdata_api'))
            .then(function (response) {
                // console.log("Response dari API:", response); // Tambahkan ini untuk melihat respons API lengkap
                // console.log("API Key:", response.data[0].api_key); // Untuk memeriksa nilai api_key
                $("#api").val(response.data[0].api_key);
                $("#number_broadcast").val(response.data[0].number_blast);
                document.getElementById("api").readOnly = true;
                document.getElementById("number_broadcast").readOnly = true;

            })
            .catch(function (error) {
                console.error(error);
            });
    }
    $scope.getDataApi();

    $scope.toggleCheckbox = function () {
        if ($scope.check_perubahan) {
            document.getElementById("api").readOnly = false;
            document.getElementById("number_broadcast").readOnly = false;
            // Lakukan tindakan ketika checkbox dicentang di sini
        } else {
            document.getElementById("api").readOnly = true;
            document.getElementById("number_broadcast").readOnly = true;
            // Lakukan tindakan ketika checkbox tidak dicentang di sini
        }
    }

    $scope.UpdateDataApi = function () {
        if ($scope.check_perubahan) {

            // Lakukan tindakan ketika checkbox dicentang di sini
        } else {
            document.getElementById("api").readOnly = true;
            document.getElementById("number_broadcast").readOnly = true;
            // Lakukan tindakan ketika checkbox tidak dicentang di sini
        }
    }
});