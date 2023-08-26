<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url() ?>public/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url() ?>public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url() ?>public/assets/css/pace.min.css" rel="stylesheet" />
    <script src="<?= base_url() ?>public/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/css/app.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/css/icons.css" rel="stylesheet">
    <!-- Sweetalert -->
    <link href="<?= base_url() ?>public/assets/sweetalert/sweetalert2.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <!-- End Sweetalert -->
    <title>Login Administrator</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper" ng-app="Auth" ng-controller="AuthController">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="border p-4 rounded-4">
                                    <div class="text-center">
                                        <img src="<?= base_url() ?>public/assets/images/logo1.png" width="70" alt="" />
                                        <h5 class="mt-3 mb-0">Hi, Selemat Datang Pada Aplikasi Pembayaran SPP Online
                                        </h5>
                                        <p class="mb-4">Silahkan Masuk Terlebih Dahulu apabila Anda Sudah terdaftar dan
                                            terdata pada manajemen pengelolaan siswa</p>
                                    </div>

                                    <div class="form-body">
                                        <form class="row g-3">
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Username</label>
                                                <input type="text" class="form-control rounded-5" id="username" placeholder="Username" ng-model="username">
                                            </div>
                                            <div class="col-12">

                                                <input type="password" class="form-control rounded-5" id="inputChoosePassword" placeholder="Enter Password" ng-model="password">
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="authentication-forgot-password.html">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-gradient-info rounded-5" ng-click="Login()"><i class="bx bxs-lock-open"></i>Sign
                                                        in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>public/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url() ?>public/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!-- sweetalert -->
    <!-- Angular -->
    <script src="<?= base_url() ?>public/assets/angular/angular.js"></script>
    <script src="<?= base_url() ?>public/assets/angular/angular.min.js"></script>
    <script src="<?= base_url() ?>public/assets/angular/angular-datatables.min.js"></script>

    <!-- end angulart -->
    <!-- Sweetalert -->
    <script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.js"></script>
    <script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.all.js"></script>
    <script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.all.min.js"></script>
    <!-- end sweetalert -->
    <script src="<?= base_url() ?>public/assets/js/app.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/auth.js"></script>
</body>

</html>