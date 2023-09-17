<div class="page-wrapper" ng-app="TransaksiApp" ng-controller="TransaksiAppController">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Modul Transaksi</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Informasi Transaksi Pembayaran</h6>
        <hr />
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body p-2">
                <ul class="nav nav-tabs nav-primary bg-light text-white" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-layer font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Pembayaran Langsung</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-layer font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Pembayaran Pihak Ketiga</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                        <div class="form-group">
                            <label for="">Masukkan NISN</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nisn" id="nisn" ng-model="nisn" placeholder="Masukkan NISN Siswa">
                                <button class="btn btn-md btn-primary" ng-click="CekDataSiswa()">
                                    <i class="bx bx-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                        <table style="width: 100%;margin-top: 10px;">
                            <tr>
                                <td style="width: 15%;">NISN</td>
                                <td style="width: 2%;">:</td>
                                <td style="width: 70%;" id="nisn_list">-</td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">Nama Lengkap</td>
                                <td style="width: 2%;">:</td>
                                <td style="width: 70%;" id="nama_list">-</td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">Kelas</td>
                                <td style="width: 2%;">:</td>
                                <td style="width: 70%;" id="kelas_list">-</td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">Jenis Kelamin</td>
                                <td style="width: 2%;">:</td>
                                <td style="width: 70%;" id="jk_list">-</td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered" style="width:100%">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="dt in Transaksi" ng-if="Transaksi.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <div class="input-group">
                                                <div class="button-group">
                                                    <button class="btn btn-sm btn-success" ng-click="LakukanPembayaran(dt)">
                                                        <i class="bx bx-money"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-secondary" ng-click="ShowRiwayatPemabyaran(dt)">
                                                        <i class="bx bx-show"></i>
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
                                            <span ng-if="dt.status_bayar=='Non Payment'" class="badge bg-danger">{{dt.status_bayar}}</span>
                                            <span ng-if="dt.status_bayar=='Payment'" class="badge bg-success">{{dt.status_bayar}}</span>
                                        </td>
                                    </tr>
                                    <tr ng-if="Transaksi.length === 0">
                                        <td colspan="12" class="text-center weight">No data available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <div class="row pb-2">
                            <div class="col-md-12 text-end">
                                <button class="btn btn-md btn-primary">
                                    <i class="bx bx-refresh"></i>
                                    Refresh
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">No.</th>
                                        <th class="text-white">#Action</th>
                                        <th class="text-white">Created At</th>
                                        <th class="text-white">Status Bayar</th>
                                        <th class="text-white">NISN</th>
                                        <th class="text-white">Nama Lengkap</th>
                                        <th class="text-white">Kelas</th>
                                        <th class="text-white">Jenis Kelamin</th>
                                        <th class="text-white">No.Invoice</th>
                                        <th class="text-white">Bulan</th>
                                        <th class="text-white">Semester</th>
                                        <th class="text-white">Iuran</th>
                                        <th class="text-white">Jumlah Dibayar</th>
                                        <th class="text-white hidden">Jumlah Denda</th>
                                        <th class="text-white">Metode Bayar</th>
                                        <th class="text-white">File Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="dt in TransaksiValidasi" ng-if="TransaksiValidasi.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <div class="button-group">
                                                <button class="btn btn-md btn-dark" ng-click="ShowImagePembayaran(dt)">
                                                    <i class="bx bx-show"></i>
                                                    Check
                                                </button>
                                                <button class="btn btn-md btn-info" ng-click="KonfirmasiPembayaranClient(dt)">
                                                    <i class="bx bx-check"></i>
                                                    Valid
                                                </button>
                                            </div>
                                        </td>
                                        <td>{{dt.created_at}}</td>
                                        <td>
                                            <span ng-if="dt.status_bayar=='Menunggu Validasi'" class="badge bg-warning">{{dt.status_bayar}}</span>
                                        </td>
                                        <td>{{dt.nisn}}</td>
                                        <td>{{dt.nama}}</td>
                                        <td>{{dt.kelas}}</td>
                                        <td>{{dt.jk}}</td>
                                        <td>{{dt.no_invoice}}</td>
                                        <td>{{dt.bulan}}</td>
                                        <td>{{dt.semester}}</td>
                                        <td>{{dt.iuran}}</td>
                                        <td>{{dt.jumlah_dibayar}}</td>
                                        <td class="hidden">{{dt.denda}}</td>
                                        <td>{{dt.metode_bayar}}</td>
                                        <td>{{dt.file_image}}</td>
                                    </tr>
                                    <tr ng-if="TransaksiValidasi.length === 0">
                                        <td colspan="16" class="text-center weight">No data available
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



    <!-- Modal Pembayaran -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Tambah Data Transaksi Invoice</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group pt-2">
                            <input type="hidden" name="id_update" id="id_update" ng-model="id_update">
                        </div>
                        <div class="form-group pt-2">
                            <label for="">NISN Siswa</label>
                            <input type="text" name="nisn_bayar" id="nisn_bayar" ng-model="nisn_bayar" class="form-control" placeholder="Nama Siswa" readonly>
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Nama Siswa</label>
                            <input type="text" name="nama_bayar" id="nama_bayar" ng-model="nama_bayar" class="form-control" placeholder="Nama Siswa" readonly>
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Kelas</label>
                            <input type="text" name="kelas_bayar" id="kelas_bayar" ng-model="kelas_bayar" class="form-control" placeholder="Kelas Siswa" readonly>
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Periode</label>
                            <input type="text" name="periode_bayar" id="periode_bayar" ng-model="periode_bayar" class="form-control" placeholder="Kelas Siswa" readonly>
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Semester</label>
                            <input type="text" name="semester_bayar" id="semester_bayar" ng-model="semester_bayar" class="form-control" placeholder="Kelas Siswa" readonly>
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Masukkan Jumlah Dibayar</label>
                            <input type="number" name="jumlah_dibayar" id="jumlah_dibayar" ng-model="jumlah_dibayar" class="form-control">
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Denda Bayar</label>
                            <input type="number" name="denda_dibayar" id="denda_dibayar" ng-model="denda_dibayar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-success" ng-click="SimpanDataPembayaran()">
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



    <!-- Modal View Pembayaran Check -->
    <div id="my-modal-check" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">Check Validasi Capture</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="" alt="" id="show_image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>