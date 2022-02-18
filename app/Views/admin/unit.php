<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>
<!-- DataTables -->

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
                            <h3 class="card-title">Data Unit / Regu Dinas Perhubungan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-regu"> <i class="fa fa-plus"></i> Tambah Unit / Regu </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>UKPD</th>
                                        <th>Unit / Regu</th>
                                        <th>Jenis BAP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + (10 * ($currentPage - 1));
                                    if (count($unitPenindak) > 0) :
                                        foreach ($unitPenindak as $unit_penindak) : ?>

                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $unit_penindak["ukpd"] ?></td>
                                                <td><?= $unit_penindak["unit_penindak"] ?></td>
                                                <td><?= $unit_penindak["jenis_bap"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-xs edit" data-toggle="modal" data-target="#add-regu" data-id="<?= $unit_penindak["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-regu" data-id="<?= $unit_penindak["id"] ?>" class="btn btn-inline bg-gradient-danger btn-xs delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links('unit_penindak', 'custom_pagination'); ?>
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
<div class="modal fade" id="add-regu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah UKPD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" id="form_unit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ukpd_id" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($ukpd as $ukpd) : ?>
                                <option value="<?= $ukpd["id"] ?>"><?= $ukpd["ukpd"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorUKPD" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="unit_penindak" class="col-form-label">Unit / Regu : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="unit_penindak" name="unit_penindak" placeholder="Masukan Unit / Regu">
                        <small id="errorUnit" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="jenis_bap_id" class="col-form-label">Jenis BAP : </label>
                        <select name="jenis_bap_id" id="jenis_bap_id" class="form-control">
                            <option value="">-- Silahkan Pilih --</option>
                            <?php foreach ($jenis_bap as $jenis_bap) : ?>
                                <option value="<?= $jenis_bap["id"] ?>"><?= $jenis_bap["jenis_bap"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorJenisBap" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                        <button type="submit" class="btn btn-outline-dark update"> <i class=" fa fa-check"></i> Ubah Data</button>
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
<div class="modal fade" id="delete-regu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Delete Unit Penindak</h4>
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
    $(document).ready(function(e) {
        $("#ukpd_id").select2({
            theme: 'bootstrap4'
        });
        $("#jenis_bap_id").select2({
            theme: 'bootstrap4'
        });
    });

    $("#modal-save").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Tambah Unit Penindak');
        $("#btn-action").addClass('save');
        $("#id").val('');
        $("#ukpd_id").val('');
        $(".update").css('display', 'none')
        $(".save").css('display', 'block')
        $(".save").removeAttr('disabled', 'disabled');
        $("#unit_penindak").val('');
        $("#jeni_bap_id").val('');
    })

    $("#form_unit").submit(function(e) {
        e.preventDefault();
        var ukpd_id = $("#ukpd_id").val();
        var unit_penindak = $("#unit_penindak").val();
        var jenis_bap_id = $("#jenis_bap_id").val();
        $.ajax({
            url: "save/unit_penindak",
            type: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                unit_penindak: unit_penindak,
                jenis_bap_id: jenis_bap_id
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
                    if (response.error.unit_penindak) {
                        $("#unit_penindak").addClass('is-invalid');
                        $("#errorUnit").html(response.error.unit_penindak);
                    } else {
                        $("#unit_penindak").removeClass('is-invalid');
                        $("#errorUnit").html('');
                    }
                    if (response.error.jenis_bap_id) {
                        $("#jenis_bap_id").addClass('is-invalid');
                        $("#errorJenisBap").html(response.error.jenis_bap_id);
                    } else {
                        $("#jenis_bap_id").removeClass('is-invalid');
                        $("#errorJenisBap").html('');
                    }

                } else {
                    $("#add-regu").modal('hide');
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

        $(".modal-title").html('Edit Unit Penindak');
        $(".save").css('display', 'none');
        $(".save").attr('disabled', 'disabled');
        $(".update").css('display', 'block');
        $.ajax({
            url: 'edit/unit_penindak',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#ukpd_id").val(response.ukpd_id).trigger('change');
                $("#ukpd").removeClass('is-invalid');
                $("#errorUKPD").html('');
                $("#unit_penindak").val(response.unit_penindak);
                $("#unit_penindak").removeClass('is-invalid');
                $("#errorName").html('');
                $("#jenis_bap_id").val(response.jenis_bap_id).trigger('change');
                $("#jenis_bap_id").removeClass('is-invalid');
                $("#errorJenisBap").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var ukpd_id = $("#ukpd_id").val();
        var unit_penindak = $("#unit_penindak").val();
        var jenis_bap_id = $("#jenis_bap_id").val();
        $.ajax({
            url: 'update/unit_penindak',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                unit_penindak: unit_penindak,
                jenis_bap_id: jenis_bap_id
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
            url: 'edit/unit_penindak',
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
            url: 'delete/unit_penindak',
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