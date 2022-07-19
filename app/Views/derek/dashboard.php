<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h5 class="mt-4 mb-2">Laporan Penindakan Harian Regu </h5>
            <div class="row">
                <div class="col-md-12 col-md-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa fa-calendar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Jumlah Penindakan</span>
                            <span class="info-box-text"><?= date('d F Y') ?></span>

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
            <h5 class="mt-3 mb-2"> Jumlah BAPC </h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">BAPC Terdaftar</span>
                            <span class="info-box-number"> Lembar</span>

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
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sisa BAPC</span>
                            <span class="info-box-number"> Lembar</span>

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
                            <span class="info-box-text">Terpakai</span>
                            <span class="info-box-number"> Lembar</span>

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
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fa fa-hdd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Disetorkan</span>
                            <span class="info-box-number"> Lembar</span>

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
                            <span class="info-box-text">Rusak</span>
                            <span class="info-box-number">Lembar</span>

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

            <!-- /.col -->


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>

</script>
<?= $this->endSection(); ?>