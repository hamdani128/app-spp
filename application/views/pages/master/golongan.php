<div class="page-wrapper" ng-app="MasterGolongan" ng-controller="MasterGolonganController">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Modul Golongan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Golongan Bantuan</li>
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
        <h6 class="mb-0 text-uppercase">Informasi Golongan Bantuan</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Golongan</th>
                                <th>Nominal Bantuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                <td>{{$index + 1}}</td>
                                <td>{{dt.golongan}}</td>
                                <td>{{dt.jumlah}}</td>
                                <td>
                                    <div class="input-group">
                                        <div class="button-group">
                                            <button class="btn btn-sm btn-danger" ng-click="Delete(dt)">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" ng-click="ShowEdit(dt)">
                                                <i class="bx bx-edit"></i>
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
                                <th>Golongan</th>
                                <th>Nominal Bantuan</th>
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
                    <h5 class="modal-title text-white">Tambah Data Golongan</h5>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Golongan</label>
                                <input type="text" name="golongan" id="golongan" class="form-control" placeholder="Masukkan Jenis Golongan">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal Bantuan</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan Jenis Golongan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-primary" ng-click="SimpanGolongan()">
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
                    <h5 class="modal-title text-white">Update Data Golongan</h5>
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
                                <label for="">Golongan</label>
                                <input type="text" name="golongan_update" id="golongan_update" class="form-control" placeholder="Masukkan Jenis Golongan">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal Bantuan</label>
                                <input type="number" name="jumlah_update" id="jumlah_update" class="form-control" placeholder="Masukkan Jenis Golongan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-warning" ng-click="UpdateGolongan()">
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