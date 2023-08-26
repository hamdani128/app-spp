<div class="page-wrapper" ng-app="MasterSpp" ng-controller="MasterSppController">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Modul Master</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data SPP</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Panel Action</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                        <a class="dropdown-item" href="javascript:;" ng-click="AddSpp()">
                            <i class="bx bx-plus"></i>
                            Tambah Data
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <i class="bx bx-download"></i>
                            Import Data
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Informasi Data SPP</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select ng-change="CekDataKelas()" ng-model="cmb_kelas" name="cmb_kelas" id="cmb_kelas"
                                class="form-control">
                                <option value="">Pilih Kelas</option>
                                <option ng-repeat="option in kelasOptions" value="{{option.id}}">{{option.kelas}}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Action</th>
                                        <th>Kelas</th>
                                        <th>Bulan</th>
                                        <th>Semester</th>
                                        <th>Iuran</th>
                                        <th>Denda</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <div class="input-group">
                                                <div class="button-group">
                                                    <!-- <button class="btn btn-sm btn-danger" ng-click="InfoSppDelete(dt)">
                                                        <i class="bx bx-trash"></i>
                                                    </button> -->
                                                    <button class="btn btn-sm btn-warning" ng-click="InfoSppShow(dt)">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{dt.kelas}}</td>
                                        <td>{{dt.bulan}}</td>
                                        <td>{{dt.semester}}</td>
                                        <td>{{dt.iuran}}</td>
                                        <td>{{dt.denda}}</td>
                                    </tr>
                                    <tr ng-if="LoadData.length === 0">
                                        <td colspan="7" class="text-center weight">No data available</td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Action</th>
                                        <th>Kelas</th>
                                        <th>Bulan</th>
                                        <th>Semester</th>
                                        <th>Iuran</th>
                                        <th>Denda</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- modal Add -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Data Info SPP</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select ng-model="cmb_kelas_add" name="cmb_kelas_add" id="cmb_kelas_add"
                                    class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    <option ng-repeat="option in kelasOptionsAdd" value="{{option.id}}">{{option.kelas}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <table id="sppTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Bulan</th>
                                            <th>Semester</th>
                                            <th>Iuran</th>
                                            <th>Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($bulanArray as $index => $bulan) { ?>
                                        <tr>
                                            <td>
                                                <label for=""><?= $no++; ?></label>
                                            </td>
                                            <td><?= $bulan; ?></td>
                                            <td>
                                                <select class="form-control" name="cmb_semester" id="cmb_semester">
                                                    <option values="">Pilih Semester</option>
                                                    <option value="I">I</option>
                                                    <option value="II">II</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="iuran" id="iuran" class="form-control"
                                                    placeholder="Jumlah Iuran">
                                            </td>
                                            <td>
                                                <input type="number" name="denda" id="denda" class="form-control"
                                                    placeholder="Jumlah Denda">
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-primary" ng-click="SimpanDataSpp()">
                                <i class="bx bx-edit"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- modal update -->
    <div id="my-modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Update Data SPP</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id_update" id="id_update" ng-model="id_update">
                            </div>
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <h6>{{ kelas }}</h6>
                            </div>
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <h6>{{ bulan }}</h6>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Iruan</label>
                                <input type="number" name="jumlah_iuran_update" id="jumlah_iuran_update"
                                    class="form-control" placeholder="Jumlah Iuran">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Denda</label>
                                <input type="number" name="denda_iuran_update" id="denda_iuran_update"
                                    class="form-control" placeholder="Jumlah Denda">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-warning" ng-click="UpdateDataSpp()">
                                <i class="bx bx-edit"></i>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>