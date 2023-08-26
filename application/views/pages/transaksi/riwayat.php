<div class="page-wrapper" ng-app="RiwayatTransaksiApp" ng-controller="RiwayatTransaksiAppController">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Modul Transaksi</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Riwayat Transaksi</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Informasi Riwayat Transaksi Pembayaran Pembayaran</h6>
        <hr />
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="row pb-2">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tanggal Filter</label>
                            <div class="input-group">
                                <input type="date" name="tanggal_filter" id="tanggal_filter" ng-model="tanggal_filter" placeholder="Tanggal Filter" class="form-control">
                                <button class="btn btn-md btn-dark" ng-click="FilterData()">
                                    <i class="bx bx-filter"></i>
                                </button>
                                <button class="btn btn-md btn-info">
                                    <i class="bx bx-printer"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tb_riwayat" datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">No.</th>
                                        <th class="text-white">Action</th>
                                        <th class="text-white">No.Invoice</th>
                                        <th class="text-white">NISN</th>
                                        <th class="text-white">Nama Lengkap</th>
                                        <th class="text-white">Kelas</th>
                                        <th class="text-white">Bulan</th>
                                        <th class="text-white">Semester</th>
                                        <th class="text-white">Iuran</th>
                                        <th class="text-white">Jumlah Dibayar</th>
                                        <th class="text-white">Jumlah Denda</th>
                                        <th class="text-white">Status Bayar</th>
                                        <th class="text-white">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="dt in Transaksi" ng-if="Transaksi.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <div class="input-group">
                                                <div class="button-group">
                                                    <button class="btn btn-sm btn-info" ng-click="CetakPembayaran(dt)">
                                                        <i class="bx bx-printer"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{dt.no_invoice}}</td>
                                        <td>{{dt.nisn}}</td>
                                        <td>{{dt.nama}}</td>
                                        <td>{{dt.kelas}}</td>
                                        <td>{{dt.bulan}}</td>
                                        <td>{{dt.semester}}</td>
                                        <td>{{dt.iuran}}</td>
                                        <td>{{dt.jumlah_dibayar}}</td>
                                        <td>{{dt.denda}}</td>
                                        <td>
                                            <span ng-if="dt.status_bayar=='Non Payment'" class="badge bg-danger">{{dt.status_bayar}}</span>
                                            <span ng-if="dt.status_bayar=='Payment'" class="badge bg-success">{{dt.status_bayar}}</span>
                                        </td>
                                        <td>{{dt.updated_at}}</td>
                                    </tr>
                                    <tr ng-if="Transaksi.length === 0">
                                        <td colspan="13" class="text-center weight">No data available</td>
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