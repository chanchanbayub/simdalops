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
                            <h3 class="card-title">Data UKPD Dinas Perhubungan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-ukpd"> <i class="fa fa-plus"></i> Tambah UKPD </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>UKPD</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (count($ukpd) > 0) :
                                        foreach ($ukpd as $ukpd) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $ukpd["ukpd"] ?></td>
                                                <td><?= $ukpd["nama_dinas"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-sm edit" data-toggle="modal" data-target="#add-ukpd" data-id="<?= $ukpd["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-ukpd" data-id="<?= $ukpd["id"] ?>" class="btn btn-inline bg-gradient-danger btn-sm delete-data"> <i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="add-ukpd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah UKPD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ukpd" class="col-form-label">UKPD :</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="ukpd" name="ukpd" placeholder="Masukan Nama UKPD">
                        <small id="errorUKPD" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_dinas" class="col-form-label">Nama Suku Dinas : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_dinas" name="nama_dinas" placeholder="Masukan Nama Suku Dinas">
                        <small id="errorName" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="button" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-outline-dark update"> <i class="fa fa-check"></i> Simpan</button>
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
<div class="modal fade" id="delete-ukpd">
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
<!-- <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
<!-- <script src="/assets/plugins/jquery/jquery.min.js"></script> -->
<script>
    $("#modal-save").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Tambah UKPD');
        $("#btn-action").addClass('save');
        $("#id").val('');
        $("#ukpd").val('');
        $(".update").css('display', 'none')
        $(".save").css('display', 'block')
        $("#nama_dinas").val('');
    })

    $(".save").click(function(e) {
        e.preventDefault();
        var ukpd = $("#ukpd").val();
        var nama_dinas = $("#nama_dinas").val();
        $.ajax({
            url: "save/ukpd",
            type: 'post',
            dataType: 'json',
            data: {
                ukpd: ukpd,
                nama_dinas: nama_dinas
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {

                    if (response.error.ukpd) {
                        $("#ukpd").addClass('is-invalid');
                        $("#errorUKPD").html(response.error.ukpd);
                    } else {
                        $("#ukpd").removeClass('is-invalid');
                        $("#errorUKPD").html('');
                    }
                    if (response.error.nama_dinas) {
                        $("#nama_dinas").addClass('is-invalid');
                        $("#errorName").html(response.error.nama_dinas);
                    }
                } else {
                    $("#add-ukpd").modal('hide');
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
        $(".modal-title").html('Edit UKPD');
        $(".save").css('display', 'none');
        $(".update").css('display', 'block');
        $.ajax({
            url: 'edit/ukpd',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#ukpd").val(response.ukpd);
                $("#ukpd").removeClass('is-invalid');
                $("#errorUKPD").html('');
                $("#nama_dinas").val(response.nama_dinas);
                $("#nama_dinas").removeClass('is-invalid');
                $("#errorName").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var ukpd = $("#ukpd").val();
        var nama_dinas = $("#nama_dinas").val();
        $.ajax({
            url: 'update/ukpd',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                ukpd: ukpd,
                nama_dinas: nama_dinas
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
        $(".modal-title").html('Delete UKPD');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/ukpd',
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
            url: 'delete/ukpd',
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