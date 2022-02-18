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
                            <h3 class="card-title">Data Pool Penyimpanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-pool"> <i class="fa fa-plus"></i> Tambah Pool Penyimpanan </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Jenis Penindakan </th>
                                        <th>Nama Pool Penyimpanan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + (5 * ($currentPage - 1));
                                    if (count($penyimpanan) > 0) :
                                        foreach ($penyimpanan as $penyimpanan) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $penyimpanan["nama_penindakan"] ?></td>
                                                <td><?= $penyimpanan["nama_terminal"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-sm edit" data-toggle="modal" data-target="#add-pool" data-id="<?= $penyimpanan["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-pool" data-id="<?= $penyimpanan["id"] ?>" class="btn btn-inline bg-gradient-danger btn-sm delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links('poolpenyimpanan', 'custom_pagination') ?>
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
<div class="modal fade" id="add-pool">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah Pool Penyimpanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="penindakan_id" class="col-form-label">Jenis Penindakan:</label>
                        <select name="penindakan_id" id="penindakan_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($penindakan as $penindakan) :  ?>
                                <option value="<?= $penindakan["id"]; ?>"> <?= $penindakan["nama_penindakan"] ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <small id="errorPenindakan" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_terminal" class="col-form-label">Nama Penyimpanan:</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_terminal" name="nama_terminal" placeholder="Masukan Nama Penyimpanan">
                        <small id="errorTerminal" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                        <button type="submit" class="btn btn-outline-dark update"> <i class="fa fa-check"></i>Ubah Data</button>
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
<div class="modal fade" id="delete-pool">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Delete UKPD</h4>
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
<script>
    $(document).ready(function() {
        $("#penindakan_id").select2({
            theme: "bootstrap4"
        });
    })

    $("#modal-save").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Tambah Pool Penyimpanan');
        $("#id").val('');
        $(".update").css('display', 'none').attr('disabled', 'disabled');
        $(".save").css('display', 'block').removeAttr('disabled', 'disabled');
        $("#nama_terminal").val('');
        $("#nama_terminal").removeClass('is-invalid');
        $("#errorTerminal").html('');

        $("#penindakan_id").val('');
        $('#penindakan_id').removeClass('is-invalid');
        $('#errorPenindakan').html('');
    })

    $(".save").click(function(e) {
        e.preventDefault();
        var penindakan_id = $("#penindakan_id").val();
        var terminal = $("#nama_terminal").val();
        $.ajax({
            url: "save/pool_penyimpanan",
            type: 'post',
            dataType: 'json',
            data: {
                penindakan_id: penindakan_id,
                nama_terminal: terminal,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {
                    if (response.error.penindakan_id) {
                        $('#penindakan_id').addClass('is-invalid');
                        $('#errorPenindakan').html(response.error.penindakan_id);
                    } else {
                        $('#penindakan_id').removeClass('is-invalid');
                        $('#errorPenindakan').html('');
                    }
                    if (response.error.nama_terminal) {
                        $("#nama_terminal").addClass('is-invalid');
                        $("#errorTerminal").html(response.error.nama_terminal);
                    } else {
                        $("#nama_terminal").removeClass('is-invalid');
                        $("#errorTerminal").html('');
                    }

                } else {
                    $("#add-pool").modal('hide');
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
        $(".modal-title").html('Edit Pool Penyimpanan');
        $(".save").css('display', 'none');
        $(".save").attr('disabled', 'disabled');
        $(".update").css('display', 'block');
        $.ajax({
            url: 'edit/pool_penyimpanan',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#penindakan_id").val(response.penindakan_id);
                $("#penindakan_id").removeClass('is-invalid');
                $("#errorPenindakan").html('');
                $("#nama_terminal").val(response.nama_terminal);
                $("#nama_terminal").removeClass('is-invalid');
                $("#errorTerminal").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var penindakan_id = $("#penindakan_id").val();
        var nama_terminal = $("#nama_terminal").val();
        $.ajax({
            url: 'update/pool_penyimpanan',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                penindakan_id: penindakan_id,
                nama_terminal: nama_terminal
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
        $(".modal-title").html('Hapus Pool Penyimpanan');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/pool_penyimpanan',
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
            url: 'delete/pool_penyimpanan',
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


    // $(document).ready(function() {
    //     $('#example2').DataTable({
    //         "paging": true,
    //         "lengthChange": false,
    //         "searching": false,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": true,
    //         "processing": false,
    //         "responsive": true,
    //     });
    // });
</script>
<?= $this->endSection(); ?>