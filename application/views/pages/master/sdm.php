<div class="page-wrapper" ng-app="MasterSDM" ng-controller="MasterSDMController">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Modul Master</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Manajemen SDM</li>
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
                        <a class="dropdown-item" href="javascript:;" ng-click="Add()">
                            <i class="bx bx-plus"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Informasi Manajemen SDM</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Fullname</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Status Account</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                <td>{{$index + 1}}</td>
                                <td>{{dt.kode}}</td>
                                <td>{{dt.fullname}}</td>
                                <td>{{dt.jenis_kelamin}}</td>
                                <td>{{dt.jabatan}}</td>
                                <td>
                                    <span ng-if="dt.status=='Non Active'"
                                        class="badge bg-secondary">{{dt.status}}</span>
                                    <span ng-if="dt.status=='Active'" class="badge bg-primary">{{dt.status}}</span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="button-group">
                                            <button class="btn btn-sm btn-danger" ng-click="Delete(dt)">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" ng-click="ShowEdit(dt)">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-info" ng-click="ActivasiAccount(dt)">
                                                <i class="bx bx-check-shield"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr ng-if="LoadData.length === 0">
                                <td colspan="3" class="text-center weight">No data available</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Fullname</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Status Account</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- modal Add -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Data Manajemen SDM</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Fullname</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Jenis Kelamin</label>
                                <select name="cmb_jk" id="cmb_jk" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan Jabatan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-primary" ng-click="SimpanSDM()">
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
                    <h5 class="modal-title text-white">Update Data Manajemen SDM</h5>
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
                                <label for="">Fullname</label>
                                <input type="text" name="fullname_update" id="fullname_update" class="form-control" placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Jenis Kelamin</label>
                                <select name="cmb_jk_update" id="cmb_jk_update" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group pt-2">
                                <label for="">Jabatan</label>
                                <input type="text" name="jabatan_update" id="jabatan_update" class="form-control" placeholder="Masukkan Jabatan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-warning" ng-click="UpdateSDM()">
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