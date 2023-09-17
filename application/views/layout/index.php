<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url() ?>public/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url() ?>public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url() ?>public/assets/css/pace.min.css" rel="stylesheet" />
    <script src="<?= base_url() ?>public/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/css/app.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/css/icons.css" rel="stylesheet">
    <!--  -->
    <link href="<?= base_url() ?>public/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />


    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/header-colors.css" />
    <!-- sweetalerr -->
    <link href="<?= base_url() ?>public/assets/sweetalert/sweetalert2.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/assets/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <title>Amdash - Bootstrap 5 Admin Dashboard Template</title>
    </ head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <?php require_once 'sidebar.php' ?>
        <!--end sidebar wrapper -->
        <!--start header -->
        <?php require_once 'header.php' ?>
        <!--end header -->
        <!--start page wrapper -->
        <?php if ($content) { ?>
        <?php $this->load->view($content); ?>
        <?php } ?>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode">
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark" checked>
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
            <hr />
            <h6 class="mb-0">Sidebar Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>public/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url() ?>public/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
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
    <!-- end Sweetalert -->

    <script src="<?= base_url() ?>public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="<?= base_url() ?>public/assets/js/index2.js"></script>

    <!--app JS-->
    <script src="<?= base_url() ?>public/assets/js/app.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/kelas.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/spp.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/siswa.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/transaksi.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/riwayat_transaksi.js"></script>
    <script src="<?= base_url() ?>public/assets/custom/home_siswa.js"></script>

    <script src="<?= base_url() ?>public/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script src="<?= base_url() ?>public/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script>
    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#image-uploadify').imageuploadify();
    })
    </script>
</body>

</html>