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
                            <h3 class="card-title">Data Jenis Bap Penindakan Dinas Perhubungan Perhubungan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-jenisBAP"> <i class="fa fa-plus"></i> Tambah Jenis BAP </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>UKPD </th>
                                        <th>Jenis BAP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (count($jenis_bap) > 0) :
                                        foreach ($jenis_bap as $jenis_bap) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $jenis_bap["ukpd"] ?></td>
                                                <td><?= $jenis_bap["jenis_bap"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-xs edit" data-toggle="modal" data-target="#add-jenisBAP" data-id="<?= $jenis_bap["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-jenisBAP" data-id="<?= $jenis_bap["id"] ?>" class="btn btn-inline bg-gradient-danger btn-xs delete-data"> <i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="add-jenisBAP">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah Jenis BAP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" autofocus id="formJenisBap">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ukpd_id">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id" class="form-control">
                            <option value=""> -- Silahkan Pilih --</option>
                            <?php foreach ($ukpd as $ukpd) : ?>
                                <option value="<?= $ukpd["id"] ?>"> <?= $ukpd["ukpd"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorUkpd" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="jenis_bap">Jenis BAP :</label>
                        <input type="text" style="text-transform: capitalize;" name="jenis_bap" id="jenis_bap" class="form-control" placeholder="Masukan Jenis BAP">
                        <small id="errorBap" class="text-danger"></small>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan </button>
                        <button type="button" class="btn btn-outline-dark update"> <i class="fa fa-check"></i> Ubah </button>
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
<div class="modal fade" id="delete-jenisBAP">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Hapus Jenis BAP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="id" name="id" id="id_delete">
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
    $(document).ready(function() {
        $("#ukpd_id").select2({
            theme: 'bootstrap4'
        });
    })

    $("#modal-save").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Tambah Jenis BAP');
        $("#id").val('');
        $("#ukpd_id").val('');
        $("#jenis_bap").val('');
        $(".update").css('display', 'none');
        $(".update").attr('disabled', 'disabled');
        $(".save").css('display', 'block');
        $(".save").removeAttr('disabled', 'disabled');
    });

    $(".save").click(function(e) {
        e.preventDefault();
        let ukpd_id = $("#ukpd_id").val();
        let jenis_bap = $("#jenis_bap").val();
        $.ajax({
            url: "save/jenis_bap",
            type: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                jenis_bap: jenis_bap
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#errorUkpd").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#errorUkpd").html('');
                    }
                    if (response.error.jenis_bap) {
                        $("#jenis_bap").addClass('is-invalid');
                        $("#errorBap").html(response.error.jenis_bap);
                    } else {
                        $("#jenis_bap").removeClass('is-invalid');
                        $("#errorBap").html('');
                    }
                } else {
                    $("#add-jenisBAP").modal('hide');
                    Swal.fire({
                        title: `${response.success}`,
                        icon: 'success'
                    })
                    setInterval(() => {
                        document.location.reload();
                    }, 500);
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
            url: 'edit/jenis_bap',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#ukpd_id").val(response.ukpd_id).trigger('change');
                $("#ukpd_id").removeClass('is-invalid');
                $("#errorUkpd").html('');

                $("#jenis_bap").val(response.jenis_bap);
                $("#jenis_bap").removeClass('is-invalid');
                $("#errorUkpd").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var ukpd_id = $("#ukpd_id").val();
        var jenis_bap = $("#jenis_bap").val();
        $.ajax({
            url: 'update/jenis_bap',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                jenis_bap: jenis_bap,
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
        $(".modal-title").html('Hapus Jenis BAP');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/jenis_bap',
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
            url: 'delete/jenis_bap',
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