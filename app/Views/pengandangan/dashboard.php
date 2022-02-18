<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h5 class="mt-4 mb-2">Jumlah Kendaraan Masuk </h5>
            <div class="row">
                <div class="col-md-3 col-md-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fa fa-car"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Kendaraan Masuk</span>
                            <span class="info-box-number"></span>

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
                        <span class="info-box-icon"><i class="fa fa-car-side "></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Kendaraan Keluar</span>
                            <span class="info-box-number"></span>

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