<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="/assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- end select 2 -->
    <link rel="shortcut icon" href="https://3.bp.blogspot.com/-1aWsvIfu95A/W6XY0r7XX0I/AAAAAAAAD3s/LOn2CDpfLyUniUWAXeTeJ-yHZKUyZP0QACLcBGAs/s1600/dishub.png" type="image/png">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->
        <?php if (session('role_management') == 'Admin') : ?>
            <?= $this->include('layout/sidebar'); ?>
        <?php elseif (session("role_management") == 'Petugas') : ?>
            <?= $this->include('layout/sidebar-petugas'); ?>
        <?php elseif (session("role_management") == 'Operator') : ?>
            <?= $this->include('layout/sidebar_operator'); ?>
        <?php elseif (session("role_management") == 'Verifikator') : ?>
            <?= $this->include('layout/sidebar_verifikator'); ?>
        <?php elseif (session("role_management") == 'Kepala Seksi') : ?>
            <?= $this->include('layout/sidebar_kasie'); ?>
        <?php elseif (session("role_management") == 'Kepala Bidang') : ?>
            <?= $this->include('layout/sidebar_kabid'); ?>
        <?php elseif (session("role_management") == 'Pengandangan') : ?>
            <?= $this->include('layout/sidebar_pengandangan'); ?>
        <?php endif; ?>
        <?= $this->renderSection('content'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->

        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-sm-right d-none d-sm-inline">
                E-Tilang Dinas Perhubungan &copy; 2014-2021
            </div>
            <!-- Default to the left -->
            <strong></strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <!-- <script src="/assets/plugins/jquery/jquery.min.js"></script> -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <!-- Sweet Alert -->
    <script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/plugins/select2/js/select2.min.js"></script>

    <script src="/assets/webcam/webcam.min.js"></script>

</body>

</html>