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
                            <h3 class="card-title">Data Status BAP Dinas Perhubungan Perhubungan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-status"> <i class="fa fa-plus"></i> Tambah Status BAP </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Status BAP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (count($statusBap) > 0) :
                                        foreach ($statusBap as $statusBap) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $statusBap["status_bap"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-sm edit" data-toggle="modal" data-target="#add-status" data-id="<?= $statusBap["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-status" data-id="<?= $statusBap["id"] ?>" class="btn btn-inline bg-gradient-danger btn-sm delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" align="center">Tidak Ada Data</td>
                                        </tr>
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
<div class="modal fade" id="add-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah Status Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" autofocus>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="status_bap" class="col-form-label">Status Surat :</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="status_bap" name="status_bap" placeholder="Masukan Status Surat">
                        <small id="errorStatus" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan Status</button>
                        <button type="button" class="btn btn-outline-dark update"> <i class="fa fa-check"></i> Ubah Status</button>
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
<div class="modal fade" id="delete-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Hapus Status Surat</h4>
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
    $("#modal-save").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Tambah Status Surat');
        $("#id").val('');
        $("#status_bap").val('');
        $(".update").css('display', 'none');
        $(".update").attr('disabled', 'disabled');
        $(".save").css('display', 'block');
        $(".save").removeAttr('disabled', 'disabled');
    });

    $(".save").click(function(e) {
        e.preventDefault();
        var status = $("#status_bap").val();
        $.ajax({
            url: "save/statusBap",
            type: 'post',
            dataType: 'json',
            data: {
                status_bap: status,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {

                    if (response.error.status_bap) {
                        $("#status_bap").addClass('is-invalid');
                        $("#errorStatus").html(response.error.status_bap);
                    } else {
                        $("#status_bap").removeClass('is-invalid');
                        $("#errorStatus").html('');
                    }
                } else {
                    $("#add-status").modal('hide');
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
        $(".modal-title").html('Edit Status Surat');
        $(".save").css('display', 'none');
        $(".save").attr('disabled', 'disabled');
        $(".update").css('display', 'block');
        $(".update").removeAttr('disabled', 'disabled');
        $.ajax({
            url: 'edit/statusBap',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#status_bap").val(response.status_bap);
                $("#status_bap").removeClass('is-invalid');
                $("#errorStatus").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var status = $("#status_bap").val();
        $.ajax({
            url: 'update/statusBap',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                status_bap: status,
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
        $(".modal-title").html('Hapus Status Surat');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/statusBap',
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
            url: 'delete/statusBap',
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
                    location.reload()
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