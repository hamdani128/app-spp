<div ng-app="AppSettings" ng-controller="AppSettingsController">
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Setting</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Konfigurasi dan Nomor Broadcast</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Settings API dan Nomor Broadcast</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Api Key</label>
                                <input type="text" name="api" id="api" class="form-control mt-2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Number Broadcast</label>
                                <input type="text" name="number_broadcast" id="number_broadcast"
                                    class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <input type="checkbox" id="check_perubahan" ng-model="check_perubahan"
                                ng-change=" toggleCheckbox()">
                            Cek List Jika ada perubahan data Api dan nomor
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-warning" ng-click="UpdateDataApi()">
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