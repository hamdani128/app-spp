<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?= base_url() ?>public/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Amdash</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="<?= base_url('home') ?>">
                <div class="parent-icon">
                    <i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <?php if ($this->session->userdata('level') == "Super Admin") { ?>
        <li class="menu-label">Data Master</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-grid-alt'></i>
                </div>
                <div class="menu-title">Modul Master</div>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url('adm/kelas') ?>">
                        <i class="bx bx-right-arrow-alt"></i>
                        Data Kelas
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('adm/spp') ?>">
                        <i class="bx bx-right-arrow-alt"></i>
                        Data SPP
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('adm/siswa') ?>">
                        <i class="bx bx-right-arrow-alt"></i>
                        Data Siswa
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('adm/sdm') ?>">
                        <i class="bx bx-right-arrow-alt"></i>
                        Data Petugas ( SDM )
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">Data Transaksi</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                </div>
                <div class="menu-title">Modul Transaksi</div>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url('adm/transaksi') ?>">
                        <i class="bx bx-right-arrow-alt"></i>
                        Transaksi SPP
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('adm/transaksi/riwayat') ?>">
                        <i class="bx bx-right-arrow-alt"></i>
                        Riwayata Transaksi
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>
    </ul>
    <!--end navigation-->
</div>