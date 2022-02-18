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
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan Nomor Kendaraan" autofocus>
                                            <button class="btn btn-outline-primary " type="submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                        <table id="example2" class="table  table-bordered table-responsive  table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Type Kendaraan</th>
                                    <th>Tanggal Penindakan</th>
                                    <th>Nama Terminal</th>
                                    <th>Status Kendaraan</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Foto Kendaraan</th>
                                    <th>Nama Pelanggar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (5 * ($currentPage - 1));
                                if (count($pengandangan) > 0) :
                                    foreach ($pengandangan as $pengandangan) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $no++ ?>.</td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["nopol"] ?></td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["type_kendaraan"] ?></td>
                                            <td style="vertical-align: middle;"><?= date('d F Y', strtotime($pengandangan["tanggal_penindakan"]))  ?></td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["nama_terminal"] ?></td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["status_kendaraan"] ?></td>
                                            <td style="vertical-align: middle;"><?= ($pengandangan["tanggal_keluar"] == null) ? '-' : date("d F Y", strtotime($pengandangan["tanggal_keluar"]))   ?></td>
                                            <td style="vertical-align: middle;"> <img src="/kendaraan/<?= $pengandangan["foto_kendaraan_masuk"] ?>" width="100px" alt=""></td>
                                            <td style="vertical-align: middle;"> <?= ($pengandangan["nama_pelanggar"] == null) ? "-" : $pengandangan["nama_pelanggar"] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="9" align="center">Tidak Ada Data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <br>
                        <?= $pager->links('page_pengandangan', 'custom_pagination'); ?>
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