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
                            <h3 class="card-title"> Tanggal <?= date('d F Y') ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form method="get" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan No Kendaraan" autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                        <a href="/operator/tambahPengeluaran" class="btn btn-inline btn-outline-dark btn-xs mb-3"> <i class="fa fa-plus"></i> Tambah Surat Pengeluaran </a>
                        <?php if (count($suratPengeluaran) > 0) : ?>
                            <a href="/exportExcelHarian" class="btn btn-inline btn-outline-dark btn-xs mb-3"> <i class="fa fa-file-excel"></i> Export Excel</a>
                        <?php endif; ?>
                        <table id="example2" class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr align="center">
                                    <th>No </th>
                                    <th>UKPD</th>
                                    <th>Type Kendaraan</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Lokasi Pelanggaran </th>
                                    <th>Pool Penyimpanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1 + (10 * ($currentPage - 1));
                                if (count($suratPengeluaran) > 0) :
                                    foreach ($suratPengeluaran as $pengeluaran) : ?>
                                        <tr align="center">
                                            <td style="vertical-align: middle;"><?= $nomor++ ?>.</td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["ukpd"] ?></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["type_kendaraan"]; ?></td>
                                            <td style="vertical-align: middle;"><a href="/operator/suratPengeluaran/<?= $pengeluaran["id"] ?>" class="btn btn-block btn-outline-primary btn-xs"><?= $pengeluaran["nopol"]; ?></a></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["jenis_pelanggaran"]; ?></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["lokasi_pelanggaran"]; ?></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["nama_terminal"]; ?></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["name"] ?></td>
                                            <td style="vertical-align: middle;" style="display: inline-block;">
                                                <?php if ($pengeluaran["status_surat_id"] == 3) : ?>
                                                    <a href="/surat_pengeluaran/<?= $pengeluaran["id"] ?>" target="_blank" class="btn btn-outline-success btn-xs"> <i class=" fa fa-print"></i></a>
                                                <?php endif; ?>
                                                <?php if ($pengeluaran["status_surat_id"] != 3) : ?>
                                                    <a href="/operator/edit_surat/<?= $pengeluaran["noBap"] ?>" target="_blank" class="btn  btn-outline-warning btn-xs" data-id="<?= $pengeluaran["id"] ?>"> <i class="fa fa-edit"></i></a>
                                                <?php endif; ?>
                                                <button class="btn btn-outline-danger btn-xs hapus" data-toggle="modal" data-target="#modal-delete" data-bap="<?= $pengeluaran["noBap"] ?>"> <i class=" fa fa-trash"></i></button>
                                            </td>
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
                        <?= $pager->links('surat_pengeluaran', 'custom_pagination'); ?>
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

<!-- Modal Hapus -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="text" name="noBap" id="noBap_delete">
                    <label for="">Apakah Anda Yakin ?</label>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="button" class="btn btn-outline-dark delete"> <i class="fa fa-exclamation-triangle"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(".hapus").click(function(e) {
        e.preventDefault();
        $(".modal-title").html(' <i class="fa fa-times"> </i> Hapus Surat Pengeluaran');
        let noBap = $(this).data('bap');

        // console.log(id);
        $.ajax({
            url: '/operator/editSurat',
            data: {
                noBap: noBap,
            },
            dataType: 'json',
            type: 'get',
            success: function(response) {
                $("#noBap_delete").val(response.noBap);
            }
        });
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var noBap = $("#noBap_delete").val();
        $.ajax({
            url: '/operator/hapusSurat',
            dataType: 'json',
            type: 'post',
            data: {
                noBap: noBap,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i>')
            },
            success: function(response) {
                // $(this).html('<i class="fa fa-check">');
                Swal.fire({
                    title: `${response.success}`,
                    icon: 'success',
                })
                setInterval(() => {
                    document.location.reload()
                }, 700);
            }
        });
    });
</script>
<?= $this->endSection(); ?>