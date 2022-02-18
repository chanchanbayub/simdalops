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
                                    <form method="get" id="search">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan No Kendaraan" autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
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
                                            <td style="vertical-align: middle;"><a href="/verifikator/surat_masuk/<?= $pengeluaran["id"] ?>" class="btn btn-block btn-outline-primary btn-xs"><?= $pengeluaran["nopol"]; ?></a></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["jenis_pelanggaran"]; ?></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["lokasi_pelanggaran"]; ?></td>
                                            <td style="vertical-align: middle;"><?= $pengeluaran["nama_terminal"]; ?></td>
                                            <td style="vertical-align: middle;"> <?= $pengeluaran["name"] ?> </td>
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
                        <?= $pager->links('surat_pengeluaran', 'custom_pagination') ?>
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
                    <input type="hidden" name="id" id="id_delete">
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
    $("#hapus").click(function(e) {
        e.preventDefault();
        $(".modal-title").html(' <i class="fa fa-times"> </i> Hapus Surat Pengeluaran');
        let id = $(this).data('id');
        $.ajax({
            url: 'editSurat',
            data: {
                id: id
            },
            dataType: 'json',
            type: 'get',
            success: function(response) {
                $("#id_delete").val(response.id);
            }
        });
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id = $("#id_delete").val();
        $.ajax({
            url: 'hapusSurat',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
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