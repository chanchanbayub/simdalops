<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="https://3.bp.blogspot.com/-1aWsvIfu95A/W6XY0r7XX0I/AAAAAAAAD3s/LOn2CDpfLyUniUWAXeTeJ-yHZKUyZP0QACLcBGAs/s1600/dishub.png" alt="Dishub Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Tilang Dishub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://3.bp.blogspot.com/-1aWsvIfu95A/W6XY0r7XX0I/AAAAAAAAD3s/LOn2CDpfLyUniUWAXeTeJ-yHZKUyZP0QACLcBGAs/s1600/dishub.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/verifikator/profile" class="d-block"><?= session("ukpd"); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/verifikator/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope-square"></i>
                        <p>
                            Surat Pengeluaran
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/verifikator/surat_masuk" class="nav-link">
                                <i class="fas fa-signature nav-icon"></i>
                                <p> Pengeluaran Harian </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/verifikator/arsipSurat" class="nav-link">
                                <i class="fas fa-archive nav-icon"></i>
                                <p> Arsip Surat Pengeluaran </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fa fa-key"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>