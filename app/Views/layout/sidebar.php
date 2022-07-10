<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Tilang Dishub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session("ukpd"); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ukpd" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>UKPD</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="jenis_penindakan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Penindakan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/jenis_kendaraan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/k_kendaraan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Klasifikasi Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/type_kendaraan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Type Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/pool_penyimpanan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pool Penyimpanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/role_management" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/usersManagement" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/pasal_pelanggaran" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pasal Pelanggaran </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/statusSurat" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status Surat </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/statusBap" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status BAP </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/unit_penindak" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Unit / Regu </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/lokasi_sidang" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lokasi Sidang </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/jenis_bap" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis BAP Penindakan </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Surat Pengeluaran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan Harian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fa fa-key"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>