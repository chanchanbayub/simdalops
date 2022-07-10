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
                            <h3 class="card-title">Data Lokasi Sidang Dinas Perhubungan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-lokasi"> <i class="fa fa-plus"></i> Tambah Lokasi Sidang </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>UKPD</th>
                                        <th>Lokasi Sidang</th>
                                        <th>Jalan Lokasi Sidang</th>
                                        <th>Jam Sidang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + (5 * ($currentPage - 1));
                                    if (count($lokasi_sidang) > 0) :
                                        foreach ($lokasi_sidang as $lokasi_sidang) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $lokasi_sidang["ukpd"] ?></td>
                                                <td><?= $lokasi_sidang["lokasi_sidang"] ?></td>
                                                <td><?= $lokasi_sidang["jalan"] ?></td>
                                                <td><?= $lokasi_sidang["jam"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-sm edit" data-toggle="modal" data-target="#add-lokasi" data-id="<?= $lokasi_sidang["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-lokasi" data-id="<?= $lokasi_sidang["id"] ?>" class="btn btn-inline bg-gradient-danger btn-sm delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links('lokasi_sidang', 'custom_pagination'); ?>
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
<div class="modal fade" id="add-lokasi">
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
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ukpd_id" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id" class="form-control">
                            <option value="">-- Silahkan Pilih --</option>
                            <?php foreach ($ukpd as $ukpd) : ?>
                                <option value="<?= $ukpd["id"] ?>"><?= $ukpd["ukpd"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorUKPD" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_sidang" class="col-form-label">Lokasi Sidang : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="lokasi_sidang" name="lokasi_sidang" placeholder="Masukan Lokasi Sidang">
                        <small id="errorLokasi" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="jalan" class="col-form-label">Jalan : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="jalan" name="jalan" placeholder="Masukan Lokasi Jalan Sidang">
                        <small id="errorJalan" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="jam" class="col-form-label">Jam : </label>
                        <input type="time" style="text-transform: capitalize;" class="form-control" id="jam" name="jam" placeholder="Masukan Jam Sidang">
                        <small id="errorJam" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                        <button type="submit" class="btn btn-outline-dark update"> <i class="fa fa-check"></i> Update</button>
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
<div class="modal fade" id="delete-lokasi">
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
<script>
    $(document).ready(function() {
        $("#ukpd_id").select2({
            theme: 'bootstrap4'
        });
    })

    $("#modal-save").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Tambah Lokasi Sidang');
        $("#id").val('');
        $("#ukpd_id").val('');
        $("#lokasi_sidang").val('');
        $("#jalan").val('');
        $("#jam").val('');
        $(".update").css('display', 'none')
        $(".update").attr('disabled', 'disabled')
        $(".save").css('display', 'block')
        $(".save").removeAttr('disabled', 'disabled')

    })

    $(".save").click(function(e) {
        e.preventDefault();
        var ukpd_id = $("#ukpd_id").val();
        var lokasi_sidang = $("#lokasi_sidang").val();
        var jalan = $("#jalan").val();
        var jam = $("#jam").val();
        $.ajax({
            url: "save/lokasi_sidang",
            type: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                lokasi_sidang: lokasi_sidang,
                jalan: jalan,
                jam: jam
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {

                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#errorUKPD").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#errorUKPD").html('');
                    }
                    if (response.error.lokasi_sidang) {
                        $("#lokasi_sidang").addClass('is-invalid');
                        $("#errorLokasi").html(response.error.lokasi_sidang);
                    } else {
                        $("#lokasi_sidang").removeClass('is-invalid');
                        $("#errorLokasi").html('');
                    }
                    if (response.error.jalan) {
                        $("#jalan").addClass('is-invalid');
                        $("#errorJalan").html(response.error.jalan);
                    } else {
                        $("#jalan").removeClass('is-invalid');
                        $("#errorJalan").html('');
                    }
                    if (response.error.jam) {
                        $("#jam").addClass('is-invalid');
                        $("#errorJam").html(response.error.jam);
                    } else {
                        $("#jam").removeClass('is-invalid');
                        $("#errorJam").html('');
                    }
                } else {
                    // $("#add-ukpd").modal('hide');
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
        $(".modal-title").html('Edit Lokasi');
        $(".save").css('display', 'none');
        $(".save").attr('disabled', 'disabled');
        $(".update").css('display', 'block');
        $(".update").removeAttr('disabled', 'disable');
        $.ajax({
            url: 'edit/lokasi_sidang',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#ukpd_id").val(response.ukpd_id).trigger('change');
                $("#ukpd_id").removeClass('is-invalid');
                $("#errorUKPD").html('');

                $("#lokasi_sidang").val(response.lokasi_sidang);
                $("#lokasi_sidang").removeClass('is-invalid');
                $("#errorLokasi").html('');

                $("#jalan").val(response.jalan);
                $("#jalan").removeClass('is-invalid');
                $("#errorJalan").html('');

                $("#jam").val(response.jam);
                $("#jam").removeClass('is-invalid');
                $("#errorJam").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var ukpd_id = $("#ukpd_id").val();
        var lokasi_sidang = $("#lokasi_sidang").val();
        var jalan = $("#jalan").val();
        var jam = $("#jam").val();
        $.ajax({
            url: 'update/lokasi_sidang',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                lokasi_sidang: lokasi_sidang,
                jalan: jalan,
                jam: jam
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
        $(".modal-title").html('Delete Lokasi Sidang');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/lokasi_sidang',
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
            url: 'delete/lokasi_sidang',
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
    // $('#example2').DataTable({
    // "paging": true,
    // "lengthChange": false,
    // "searching": false,
    // "ordering": true,
    // "info": true,
    // "autoWidth": true,
    // "processing": false,
    // "responsive": true,
    // });
    // });
</script>
<?= $this->endSection(); ?>