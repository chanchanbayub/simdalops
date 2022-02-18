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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <?= session("nama_dinas") ?> / <?= date('d F Y') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form method="get" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan No Bap / Nomor Kendaraan" autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                        <h4 class="text-center">Unit / Regu : <?= session('unit_penindak') ?></h4>
                        <table id="example2" class="table  table-bordered table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>No BAP</th>
                                    <th>Jenis Penindakan </th>
                                    <th>Unit Penindak</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Pasal Pelanggaran</th>
                                    <th>Lokasi Pelanggaran</th>
                                    <th>Tanggal Pelanggaran</th>
                                    <th>Pool Penyimpanan</th>
                                    <th>Foto </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (5 * ($currentPage - 1));
                                if (count($laporan_penindakan) > 0) :
                                    foreach ($laporan_penindakan as $laporan_penindakan) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $no++ ?>.</td>
                                            <td style=" vertical-align: middle;">0<?= $laporan_penindakan["noBap"] ?></td>
                                            <td style=" vertical-align: middle;"><?= $laporan_penindakan["nama_penindakan"] ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["unit_penindak"] ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["nopol"] ?></td>
                                            <td style="vertical-align: middle;">Pasal <?= $laporan_penindakan["pasal_pelanggaran"] ?></td>
                                            <td style="vertical-align: middle;">Jl <?= $laporan_penindakan["lokasi_pelanggaran"] ?></td>
                                            <td style="vertical-align: middle;"><?= date('d F Y', strtotime($laporan_penindakan["tanggal_penindakan"])) ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["nama_terminal"] ?></td>
                                            <td style="vertical-align: middle; text-align:center"> <img src=" /foto-penindakan/<?= $laporan_penindakan["foto"] ?>" width="80px" alt=""> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="10" align="center"> Tidak Ada Data </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <br>
                        <?= $pager->links('laporan_penindakan', 'custom_pagination'); ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<script src="/assets/plugins/jquery/jquery.min.js"></script>

<?= $this->endSection(); ?>