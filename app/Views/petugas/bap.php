<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>

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
                            <h3 class="card-title"> Data BAP Berdasarkan Unit / Regu <?= session('unit_penindak') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form method="get" id="search">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan No Bap" autocomplete="off">
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table id="example2" class="table table-responsive table-bordered ">
                            <thead>
                                <tr align="center">
                                    <th>No </th>
                                    <th>Unit Penindak</th>
                                    <th>No Bap</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Nama Petugas</th>
                                    <th>Tanggal Penindakan</th>
                                    <th>Jam Penindakan </th>
                                    <th>Foto Penindakan</th>
                                    <th>Status BAP</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (10 * ($currentPage - 1));
                                if (count($dataBap) > 0) :
                                    foreach ($dataBap as $data) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $no++ ?>.</td>
                                            <td style="vertical-align: middle;"><?= $data["unit_penindak"] ?></td>
                                            <td style="vertical-align: middle;"> <a href="/petugas/tambah_penindakan/<?= $data["noBap"] ?>">0<?= $data["noBap"] ?></a> </td>
                                            <td style="vertical-align: middle;"><?= $data["nopol"] ?></td>
                                            <td style="vertical-align: middle;"><?= $data["nama_petugas"] ?></td>
                                            <td style="vertical-align: middle;"><?= $data["tanggal_penindakan"] ?></td>
                                            <td style="vertical-align: middle;"><?= $data["jam_penindakan"] ?></td>
                                            <?php if ($data["foto"] != null) : ?>
                                                <td><img src="/foto-penindakan/<?= $data["foto"] ?>" width="100px" alt=""></td>
                                            <?php else : ?>
                                                <td><img src="" width="100px" alt=""></td>
                                            <?php endif; ?>
                                            <td style="vertical-align: middle;"><?= $data["status_bap"] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <br>
                        <?= $pager->links('bap', 'custom_pagination') ?>
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