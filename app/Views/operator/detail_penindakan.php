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
            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-secondary card-outline">
                        <div class="card-body box-profile">
                            <?php if ($laporan_penindakan != null) : ?>
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid " src="/foto-penindakan/<?= $laporan_penindakan["foto"] ?>" style="width:150px" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?= $laporan_penindakan["type_kendaraan"] ?></h3>

                                <p class="text-muted text-center"><?= $laporan_penindakan["nopol"] ?></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>No Bap</b> <a class="float-right">0<?= $laporan_penindakan["noBap"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Penindakan</b> <a class="float-right"><?= $laporan_penindakan["nama_penindakan"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Klasifikasi Kendaraan</b> <a class="float-right"><?= $laporan_penindakan["nama_kendaraan"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Penindakan</b> <a class="float-right"><?= date('d F Y', strtotime($laporan_penindakan["tanggal_penindakan"]))  ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Sidang</b> <a class="float-right"><?= date('d F Y', strtotime($laporan_penindakan["tanggal_sidang"]))  ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Lokasi Sidang</b> <a class="float-right"><?= $laporan_penindakan["lokasi_sidang"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pasal Pelanggaran</b> <a class="float-right">Pasal <?= $laporan_penindakan["pasal_pelanggaran"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Pelanggaran</b> <a class="float-right"> <?= $laporan_penindakan["keterangan"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pool Penyimpanan</b> <a class="float-right"> <?= $laporan_penindakan["nama_terminal"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Nama Pelanggar</b> <a class="float-right"> <?= $laporan_penindakan["nama_pelanggar"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Alamat Pelanggar</b> <a class="float-right"> <?= $laporan_penindakan["alamat_pelanggar"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Catatan </b> <a class="float-right"> <?= ($laporan_penindakan["catatan"] == null) ? "-" : $laporan_penindakan["catatan"] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Masuk BAP </b> <a class="float-right"> <?= ($laporan_penindakan["tanggal_masuk_bap"] == "0000-00-00") ? "-" : date('d F Y', strtotime($laporan_penindakan["tanggal_masuk_bap"])) ?></a>
                                    </li>
                                </ul>

                                <a href="/operator/laporan_penindakan/download/<?= $laporan_penindakan["foto"] ?>" class="btn btn-block btn-outline-dark btn-sm mb-3"> <i class="fa fa-download"></i> Download Foto Penindakan </a>

                        </div>
                        <!-- /.card-body -->

                    </div>
                <?php else : ?>
                    <p align="center">Tidak Ada Data</p>
                <?php endif; ?>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<script src="/assets/plugins/jquery/jquery.min.js"></script>

<?= $this->endSection(); ?>