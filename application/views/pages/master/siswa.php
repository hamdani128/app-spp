<div ng-app="MasterSiswa" ng-controller="MasterSiswaController">
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Modul Master</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Panel Action</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item" href="javascript:;" ng-click="AddSiswa()">
                                <i class="bx bx-plus"></i>
                                Tambah Data
                            </a>
                            <a class="dropdown-item" href="javascript:;" ng-click="ImportSiswa()">
                                <i class="bx bx-download"></i>
                                Import Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Informasi Siswa</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Action</th>
                                    <th>Kelas</th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Orang Tua Laki</th>
                                    <th>Orang Tua Perempuan</th>
                                    <th>No.HP</th>
                                    <th>Status Users</th>
                                    <th>Status Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                    <td>{{$index + 1}}</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="button-group">
                                                <button class="btn btn-sm btn-secondary" ng-click="ShowPassword(dt)">
                                                    <i class="bx bx-key"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" ng-click="SiswaDelete(dt)">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" ng-click="SiswaShow(dt)">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-dark" ng-click="AktivasiAkunSiswa(dt)">
                                                    <i class="bx bx-user"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info"
                                                    ng-click="AktivasiTransaksiSiswa(dt)">
                                                    <i class="bx bx-receipt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{dt.kelas}}</td>
                                    <td>{{dt.nisn}}</td>
                                    <td>{{dt.nama}}</td>
                                    <td>{{dt.jk}}</td>
                                    <td>{{dt.ortu_laki}}</td>
                                    <td>{{dt.ortu_perempuan}}</td>
                                    <td>{{dt.no_hp}}</td>
                                    <td>
                                        <span ng-if="dt.status_akun=='Non Active'"
                                            class="badge bg-secondary">{{dt.status_akun}}</span>
                                        <span ng-if="dt.status_akun=='Active'"
                                            class="badge bg-primary">{{dt.status_akun}}</span>
                                    </td>
                                    <td>
                                        <span ng-if="dt.status_transaksi=='Non Active'"
                                            class="badge bg-secondary">{{dt.status_transaksi}}</span>
                                        <span ng-if="dt.status_transaksi=='Active'"
                                            class="badge bg-primary">{{dt.status_transaksi}}</span>
                                    </td>
                                </tr>
                                <tr ng-if="LoadData.length === 0">
                                    <td colspan="11" class="text-center weight">No data available</td>
                                </tr>
                            </tbody>
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
                        <h5 class="modal-title text-white">Tambah Data Kelas</h5>
                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <select ng-model="cmb_kelas" name="cmb_kelas" id="cmb_kelas" class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        <option ng-repeat="option in kelasOptions" value="{{option.id}}">
                                            {{option.kelas}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">NISN</label>
                                    <input type="text" name="nisn" id="nisn" class="form-control"
                                        placeholder="Masukkan NISN" ng-model="nisn">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="Masukkan Nama Lengkap" ng-model="nama">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="cmb_jk" id="cmb_jk" class="form-control" ng-model="cmb_jk">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Nama Orang Tua Perempuan</label>
                                    <input type="text" name="ortu_perempuan" id="ortu_perempuan" class="form-control"
                                        placeholder="Masukkan Orang Tua Perempuan" ng-model="ortu_perempuan">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Nama Orang Tua Laki-Laki</label>
                                    <input type="text" name="ortu_laki" id="ortu_laki" class="form-control"
                                        placeholder="Masukkan Orang Tua Laki-Laki" ng-model="ortu_laki">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">No.HP</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                        placeholder="Masukkan No.handphone" ng-model="no_hp">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-md btn-primary" ng-click="SimpanKelas()">
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
                        <h5 class="modal-title text-white">Update Data Kelas</h5>
                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-labe
                            l="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="id_update" id="id_update" class="form-control"
                                        ng-model="id_update">
                                </div>
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <select ng-model="cmb_kelas_update" name="cmb_kelas_update" id="cmb_kelas_update"
                                        class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        <option ng-repeat="option in kelasOptions" value="{{option.id}}">
                                            {{option.kelas}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">NISN</label>
                                    <input type="text" ng-model="nisn_update" name="nisn_update" id="nisn_update"
                                        class="form-control" placeholder="Masukkan NISN">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" ng-model="nama_update" name="nama_update" id="nama_update"
                                        class="form-control" placeholder="Masukkan Nama Lengkap">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Jenis Kelamin</label>
                                    <select ng-model="cmb_jk_update" name="cmb_jk_update" id="cmb_jk_update"
                                        class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Nama Orang Tua Perempuan</label>
                                    <input type="text" ng-model="ortu_perempuan_update" name="ortu_perempuan_update"
                                        id="ortu_perempuan_update" class="form-control"
                                        placeholder="Masukkan Orang Tua Perempuan">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">Nama Orang Tua Laki-Laki</label>
                                    <input type="text" ng-model="ortu_laki_update" name="ortu_laki_update"
                                        id="ortu_laki_update" class="form-control"
                                        placeholder="Masukkan Orang Tua Laki-Laki">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="">No.HP</label>
                                    <input type="text" ng-model="no_hp_update" name="no_hp_update" id="no_hp_update"
                                        class="form-control" placeholder="Masukkan No.handphone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-md btn-warning" ng-click="UpdateDataSiswa()">
                                    <i class="bx bx-edit"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal Import -->
        <div id="my-modal-import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">Import Data Kelas</h5>
                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form_insert_siswa">
                            <div class="row">
                                <div class="form-group">
                                    <label for="my-input">Pilih Kelas</label>
                                    <select ng-model="cmb_kelas_import" name="cmb_kelas_import" id="cmb_kelas_import"
                                        class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        <option ng-repeat="option in kelasOptions" value="{{option.id}}">
                                            {{option.kelas}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group pt-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>Masukkan File Import</span>
                                        </div>
                                        <div class="col-md-5"></div>
                                        <div class="col-md-1">
                                            <a href="<?= base_url('adm/siswa/download_format') ?>">
                                                <i class="bx bx-download" style="font-size: 20px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-12">
                                            <input type="file" ng-model="fileberkas" name="fileberkas" id="fileberkas"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-md btn-success" ng-click="ImportDataSiswa()">
                                    <i class="bx bx-edit"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- password -->
        <div id="my-modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Password History</h5>
                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table datatable="ng" dt-options="vm.dtOptions"
                                        class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="dt in PasswordLoad" ng-if="PasswordLoad.length > 0">
                                                <td>{{$index + 1}}</td>
                                                <td>{{dt.username}}</td>
                                                <td>{{dt.password}}</td>
                                                <td>{{dt.created_at}}</td>
                                            </tr>
                                            <tr ng-if="PasswordLoad.length === 0">
                                                <td colspan="5" class="text-center weight">No data available</td>
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
</div>