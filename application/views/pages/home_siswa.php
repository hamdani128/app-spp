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
                            <div class="h6">Informasi List Pembayaran SPP</div>
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
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-primary bg-light text-white" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                            aria-selected="true">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-layer font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">Belum Pembayaran</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                            aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-layer font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">Progress Pembayaran</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                            aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-layer font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">validasi Pembayaran</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="tab-content py-3">
                                <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table datatable="ng" dt-options="vm.dtOptions"
                                                class="table table-striped table-bordered" style="width:100%">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-white">No.</th>
                                                        <th class="text-white">Action</th>
                                                        <th class="text-white">No.Invoice</th>
                                                        <th class="text-white">Bulan</th>
                                                        <th class="text-white">Semester</th>
                                                        <th class="text-white">Iuran</th>
                                                        <th class="text-white">Jumlah Dibayar</th>
                                                        <th class="text-white">Jumlah Denda</th>
                                                        <th class="text-white">Status Bayar</th>
                                                        <th class="text-white">Metode Bayar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="dt in Transaksi" ng-if="Transaksi.length > 0">
                                                        <td>{{$index + 1}}</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <div class="button-group">
                                                                    <button ng-if="dt.status_bayar=='Non Payment'"
                                                                        class="btn btn-sm btn-success"
                                                                        ng-click="LakukanPembayaran(dt)">
                                                                        <i class="bx bx-money"></i>
                                                                        Bayar
                                                                    </button>
                                                                    <button ng-if="dt.status_bayar=='Payment'"
                                                                        class="btn btn-sm btn-secondary"
                                                                        ng-click="ShowRiwayatPemabyaran(dt)">
                                                                        <i class="bx bx-show"></i>
                                                                        Show
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{dt.no_invoice}}</td>
                                                        <td>{{dt.bulan}}</td>
                                                        <td>{{dt.semester}}</td>
                                                        <td>{{dt.iuran}}</td>
                                                        <td>{{dt.jumlah_dibayar}}</td>
                                                        <td>{{dt.denda}}</td>
                                                        <td>
                                                            <span ng-if="dt.status_bayar=='Non Payment'"
                                                                class="badge bg-danger">{{dt.status_bayar}}</span>
                                                            <span ng-if="dt.status_bayar=='Payment'"
                                                                class="badge bg-success">{{dt.status_bayar}}</span>
                                                        </td>
                                                        <td>{{dt.metode_bayar}}</td>
                                                    </tr>
                                                    <tr ng-if="Transaksi.length === 0">
                                                        <td colspan="12" class="text-center weight">No data available
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                    <div class="table-responsive">
                                        <table datatable="ng" dt-options="vm.dtOptions"
                                            class="table table-striped table-bordered" style="width:100%">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th class="text-white">No.</th>
                                                    <th class="text-white">No.Invoice</th>
                                                    <th class="text-white">Bulan</th>
                                                    <th class="text-white">Semester</th>
                                                    <th class="text-white">Iuran</th>
                                                    <th class="text-white">Jumlah Dibayar</th>
                                                    <th class="text-white">Jumlah Denda</th>
                                                    <th class="text-white">Status Bayar</th>
                                                    <th class="text-white">Metode Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in TransaksiProgress"
                                                    ng-if="TransaksiProgress.length > 0">
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{dt.no_invoice}}</td>
                                                    <td>{{dt.bulan}}</td>
                                                    <td>{{dt.semester}}</td>
                                                    <td>{{dt.iuran}}</td>
                                                    <td>{{dt.jumlah_dibayar}}</td>
                                                    <td>{{dt.denda}}</td>
                                                    <td>
                                                        <span ng-if="dt.status_bayar=='Menunggu Validasi'"
                                                            class="badge bg-warning">{{dt.status_bayar}}</span>
                                                    </td>
                                                    <td>{{dt.metode_bayar}}</td>
                                                </tr>
                                                <tr ng-if="Transaksi.length === 0">
                                                    <td colspan="12" class="text-center weight">No data available
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                    <div class="table-responsive">
                                        <table datatable="ng" dt-options="vm.dtOptions"
                                            class="table table-striped table-bordered" style="width:100%">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th class="text-white">No.</th>
                                                    <th class="text-white">No.Invoice</th>
                                                    <th class="text-white">Bulan</th>
                                                    <th class="text-white">Semester</th>
                                                    <th class="text-white">Iuran</th>
                                                    <th class="text-white">Jumlah Dibayar</th>
                                                    <th class="text-white">Jumlah Denda</th>
                                                    <th class="text-white">Status Bayar</th>
                                                    <th class="text-white">Metode Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in TransaksiSelesai"
                                                    ng-if="TransaksiSelesai.length > 0">
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{dt.no_invoice}}</td>
                                                    <td>{{dt.bulan}}</td>
                                                    <td>{{dt.semester}}</td>
                                                    <td>{{dt.iuran}}</td>
                                                    <td>{{dt.jumlah_dibayar}}</td>
                                                    <td>{{dt.denda}}</td>
                                                    <td>
                                                        <span ng-if="dt.status_bayar=='Payment'"
                                                            class="badge bg-success">{{dt.status_bayar}}</span>
                                                    </td>
                                                    <td>{{dt.metode_bayar}}</td>
                                                </tr>
                                                <tr ng-if="Transaksi.length === 0">
                                                    <td colspan="12" class="text-center weight">No data available
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End List Pembayaran -->
    </div>

    <!-- Modal Pembayaran -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Form Transaksi Pembayaran</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="form_pembayaran_client" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group pt-2">
                                <input type="hidden" name="id_update" id="id_update" ng-model="id_update">
                            </div>
                            <div class="form-group pt-2">
                                <label for="">NISN Siswa</label>
                                <input type="text" name="nisn_bayar" id="nisn_bayar" ng-model="nisn_bayar"
                                    class="form-control" placeholder="Nama Siswa" readonly>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Nama Siswa</label>
                                <input type="text" name="nama_bayar" id="nama_bayar" ng-model="nama_bayar"
                                    class="form-control" placeholder="Nama Siswa" readonly>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas_bayar" id="kelas_bayar" ng-model="kelas_bayar"
                                    class="form-control" placeholder="Kelas Siswa" readonly>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Periode</label>
                                <input type="text" name="periode_bayar" id="periode_bayar" ng-model="periode_bayar"
                                    class="form-control" placeholder="Kelas Siswa" readonly>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Semester</label>
                                <input type="text" name="semester_bayar" id="semester_bayar" ng-model="semester_bayar"
                                    class="form-control" placeholder="Kelas Siswa" readonly>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Iuran Dibayar</label>
                                <input type="text" name="iuran_bayar" id="iuran_bayar" ng-model="semester_bayar"
                                    class="form-control" placeholder="Kelas Siswa" readonly>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Masukkan Jumlah Dibayar</label>
                                <input type="number" name="jumlah_dibayar" id="jumlah_dibayar" ng-model="jumlah_dibayar"
                                    class="form-control">
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Channel Pembayaran</label>
                                <textarea cols="5" rows="2" name="channel_bayar" id="channel_bayar" class="form-control"
                                    placeholder="Silahkan Ketika Metode pembayarannya Cth : BANK BNI atau bisa jadi pakai E-wallte seperti cth : DANA "></textarea>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Kode Referensi Channel</label>
                                <textarea cols="5" rows="2" name="kode_ref_channel" id="kode_ref_channel"
                                    class="form-control"
                                    placeholder="Masukkan Kode Refrensi Channel Pembayaran"></textarea>
                            </div>
                            <div class="form-group pt-2" style="display: none;">
                                <label for="">Denda Bayar</label>
                                <input type="number" name="denda_dibayar" id="denda_dibayar" ng-model="denda_dibayar"
                                    class="form-control">
                            </div>

                            <div class="form-group pt-2">
                                <label for="">Upload Bukti Pembayaran</label>
                                <div class="input-group">
                                    <input id="file-upload" type="file" name="files"
                                        accept=".jpg, .png, image/jpeg, image/png" multiple>
                                </div>

                            </div>
                            <div id="image-container" class="pt-2">
                                <!-- Tempat untuk menampilkan gambar yang diunggah -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-success" ng-click="SimpanDataPembayaranClient()">
                                <i class="bx bx-edit"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Pembayaran -->
</div>

<style>
.image-frame {
    border: 2px solid #ccc;
    padding: 10px;
    margin: 10px auto;
    text-align: center;
    width: 90%;
    box-sizing: border-box;
}

.image-preview {
    max-width: 100%;
    max-height: 300px;
    display: block;
    margin: 10px auto;
}
</style>