<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h5 class="mt-2 mb-2">Jumlah BAP Keluar </h5>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Regu 1.3</span>
                            <span class="info-box-number"><?= $unit_13 ?> Lembar</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Regu 1.4</span>
                            <span class="info-box-number"><?= $unit_14 ?> Lembar</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Regu 1.5</span>
                            <span class="info-box-number"><?= $unit_15 ?> Lembar</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Regu 1.6</span>
                            <span class="info-box-number"><?= $unit_16 ?> Lembar</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Regu 1.7</span>
                            <span class="info-box-number"><?= $unit_17 ?> Lembar</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Regu 1.8</span>
                            <span class="info-box-number"><?= $unit_18 ?> Lembar</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- col -->
            </div>

            <!-- /.row -->
            <h5 class="mt-2 mb-2">Jumlah Kendaraan Berdasarkan Pool Penyimpanan </h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fa fa-car"></i></span>

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
                        <span class="info-box-icon"><i class="fa fa-car"></i></i></span>

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
                        <span class="info-box-icon"><i class="fa fa-car"></i></span>

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
                        <span class="info-box-icon"><i class="fa fa-car"></i></span>

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
            <h5 class="mt-2 mb-2">Laporan Total Pengeluaran </h5>
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

            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>

</script>
<?= $this->endSection(); ?>