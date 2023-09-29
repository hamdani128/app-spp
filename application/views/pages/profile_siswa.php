<div ng-app="HomeSiswa" ng-controller="HomeSiswaController">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-2 etxt-center">
                                <img src="<?= base_url() ?>public/assets/images/logo1.png" alt=""
                                    style="height: 80%;width: 100%;">
                            </div>
                            <div class="col-md-8 text-left">
                                <table>
                                    <tr>
                                        <td>
                                            <h2>Selamat Datang Aplikasi Pembayaran E-SPP</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>SDS Muhammadiyah 11 Medan</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Jl. Sekata No. 55, Sei Agul, Kec. Medan Barat, Kota Medan, Sumatera
                                                Utara</h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- List Pembayaran -->
            <div class="row pt-2">
                <div class="card border-top border-0 border-4 border-success">
                    <div class="card-header">
                        <div class="row">
                            <div class="h6">Informasi Profile Siswa</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" style="width: 100%;">
                                    <tr>
                                        <td style="width: 15%;">NISN</td>
                                        <td style="width: 2%;">:</td>
                                        <td id="nisn_home" style="width: 65%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Nama Lengkap</td>
                                        <td style="width: 2%;">:</td>
                                        <td id="nama_home" style="width: 65%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Kelas</td>
                                        <td style="width: 2%;">:</td>
                                        <td id="kelas_home" style="width: 65%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Jenis Kelamin</td>
                                        <td style="width: 2%;">:</td>
                                        <td id="jk_home" style="width: 65%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Nama Orang Tua (PR)</td>
                                        <td style="width: 2%;">:</td>
                                        <td id="orang_tua_home_pr" style="width: 65%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Nama Orang Tua (LK)</td>
                                        <td style="width: 2%;">:</td>
                                        <td id="orang_tua_home_lk" style="width: 65%;"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Akun -->
            <div class="row pt-2">
                <div class="card border-top border-0 border-4 border-success">
                    <div class="card-header">
                        <div class="row">
                            <div class="h6">Informasi Akun</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" id="username" class="form-control mt-2">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Old Password</label>
                                    <input type="password" name="old_password" id="old_password"
                                        class="form-control mt-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-control mt-2">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control mt-2">
                                </div>

                                <div class="form-group mt-3">
                                    <button class="btn btn-md btn-warning">
                                        <i class=""></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End List Pembayaran -->
    </div>
</div>