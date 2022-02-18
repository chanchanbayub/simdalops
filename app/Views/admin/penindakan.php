<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                            <h3 class="card-title">Data Jenis Penindakan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-penindakan"> <i class="fa fa-plus"></i> Tambah Jenis Penindakan </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Nama Penindakan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (count($penindakan) > 0) :
                                        foreach ($penindakan as $penindakan) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $penindakan["nama_penindakan"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-sm edit" data-toggle="modal" data-target="#edit-penindakan" data-id="<?= $penindakan["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-penindakan" data-id="<?= $penindakan["id"] ?>" class="btn btn-inline bg-gradient-danger btn-sm delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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
<!-- Modal Tambah -->
<div class="modal fade" id="add-penindakan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah Jenis Penindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nama_penindakan" class="col-form-label">Jenis Penindakan :</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_penindakan" name="nama_penindakan" placeholder="Masukan Nama Jenis Penindakan">
                        <small id="errorPenindakan" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Edit -->
<div class="modal fade" id="edit-penindakan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Edit Jenis Penindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nama_penindakan" class="col-form-label">Jenis Penindakan :</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_penindakan_edit" name="nama_penindakan" placeholder="Masukan Nama Jenis Penindakan">
                        <small id="errorPenindakan" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark update"> <i class="fa fa-check"></i> Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Hapus -->
<div class="modal fade" id="delete-penindakan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Delete Penindakan</h4>
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
<!-- DataTables  & Plugins -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
<!-- <script src="/assets/plugins/jquery/jquery.min.js"></script> -->
<script>
    $(".save").click(function(e) {
        e.preventDefault();
        var penindakan = $("#nama_penindakan").val();
        $.ajax({
            url: "save/jenis_penindakan",
            type: 'post',
            dataType: 'json',
            data: {
                nama_penindakan: penindakan,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {

                    if (response.error.nama_penindakan) {
                        $("#nama_penindakan").addClass('is-invalid');
                        $("#errorPenindakan").html(response.error.nama_penindakan);
                    } else {
                        $("#nama_penindakan").removeClass('is-invalid');
                        $("#errorPenindakan").html('');
                    }
                } else {
                    $("#add-penindakan").modal('hide');
                    Swal.fire({
                        title: `${response.success}`,
                        icon: 'success'
                    })
                    setInterval(() => {
                        document.location.reload();
                    }, 700);
                }
            }

        });
    })

    $(".edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/jenis_penindakan',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                $("#id").val(response.id);
                $("#nama_penindakan_edit").val(response.nama_penindakan);
                $("#nama_penindakan_edit").removeClass('is-invalid');
                $("#errorPenindakan").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var nama_penindakan = $("#nama_penindakan_edit").val();
        $.ajax({
            url: 'update/jenis_penindakan',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                nama_penindakan: nama_penindakan,
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

    $(".delete-data").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Delete Penindakan');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/jenis_penindakan',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id_delete").val(response.id);
            }
        });
    })

    $(".delete").click(function(e) {
        e.preventDefault();
        var id = $("#id_delete").val();
        $.ajax({
            url: 'delete/jenis_penindakan',
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