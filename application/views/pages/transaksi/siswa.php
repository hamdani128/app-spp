<div class="page-wrapper" ng-app="SiswaTransaksiApp" ng-controller="SiswaTransaksiAppController">
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
        <h6 class="mb-0 text-uppercase">Informasi Data Transaksi Siswa Periode</h6>
        <hr />
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="row pb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Filter Data :</label>
                            <div class="input-group">
                                <select name="cmb_periode" id="cmb_periode" class="form-control">
                                    <option value="">Pilih Periode</option>
                                    <option ng-repeat="option in PeriodeData" value="{{option.bulan}}">{{option.bulan}}
                                    </option>
                                </select>
                                <select name="cmb_kelas" id="cmb_kelas" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    <option ng-repeat="option in KelasData" value="{{option.kelas}}">{{option.kelas}}
                                    </option>
                                </select>
                                <button class="btn btn-md btn-dark" ng-click="FilterDataSiswaTransaksi()">
                                    <i class="bx bx-filter"></i>
                                </button>

                            </div>
                        </div>
                        <div class="form-group pt-3">
                            <button class="btn btn-md btn-success" ng-click="RemindMessage()">
                                <i class="bx bx-chat"></i>
                                Remind
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tb_riwayat" datatable="ng" dt-options="vm.dtOptions"
                                class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">#</th>
                                        <th class="text-white">Act</th>
                                        <th class="text-white">No.</th>
                                        <th class="text-white">Status Bayar</th>
                                        <th class="text-white">Created At</th>
                                        <th class="text-white">NISN</th>
                                        <th class="text-white">Nama Lengkap</th>
                                        <th class="text-white">Kelas</th>
                                        <th class="text-white">Bulan</th>
                                        <th class="text-white">Semester</th>
                                        <th class="text-white">Iuran</th>
                                        <th class="text-white">Jumlah Dibayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="dt in DataTransaksi" ng-if="DataTransaksi.length > 0">
                                        <td>
                                            <input type="checkbox" name="" id="" ng-model="selectedItems[dt.id]"
                                                ng-disabled="dt.status_bayar === 'Payment'">
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="button-group">
                                                    <button class="btn btn-sm btn-info" ng-click="CetakPembayaran(dt)">
                                                        <i class="bx bx-printer"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <span ng-if="dt.status_bayar=='Non Payment'"
                                                class="badge bg-danger">{{dt.status_bayar}}</span>
                                            <span ng-if="dt.status_bayar=='Payment'"
                                                class="badge bg-success">{{dt.status_bayar}}</span>
                                        </td>
                                        <td>{{dt.updated_at}}</td>
                                        <td>{{dt.nisn}}</td>
                                        <td>{{dt.nama}}</td>
                                        <td>{{dt.kelas}}</td>
                                        <td>{{dt.bulan}}</td>
                                        <td>{{dt.semester}}</td>
                                        <td>{{dt.iuran}}</td>
                                        <td>{{dt.jumlah_dibayar}}</td>
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