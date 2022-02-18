<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php if ($profile == null) : ?>
                <div class="row">
                    <div class="col-md-12 col-md-6 col-12">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="far fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Silahkan Lengkapi Profil Anda</span>
                                <span class="info-box-text"><a style="color: white;" class="btn btn-outline-secondary" href="/verifikator/profile"> <i class="fas fa-hand-pointer"></i> Klik Disini!</a></span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            <?php endif; ?>
            <h5 class="mt-4 mb-2">Laporan Total Pengeluaran </h5>
            <div class="row">
                <div class="col-md-3 col-md-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa fa-calendar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Laporan Total Pengeluaran Harian</span>
                            <span class="info-box-number"><?= $totalHarian ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-md-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa fa-book"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Laporan Total Pengeluaran Keseluruhan</span>
                            <span class="info-box-number"><?= $totalKeseluruhan ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <h5 class="mt-4 mb-2">Jumlah Kendaraan Berdasarkan Pool Penyimpanan </h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rawa Buaya</span>
                            <span class="info-box-number"> <?= $totalRawaBuaya ?> </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pulo Gadung</span>
                            <span class="info-box-number"><?= $totalPuloGadung ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 1000%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pulo Gebang</span>
                            <span class="info-box-number"><?= $totalPuloGebang ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tanah Merdeka</span>
                            <span class="info-box-number"><?= $totalTanahMerdeka ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- /.row -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>

</script>
<?= $this->endSection(); ?>