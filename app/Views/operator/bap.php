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
                        <div class="card-body" style="overflow: auto;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="get" id="search">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="keyword.." autocomplete="off" autofocus>
                                            <br>
                                            <div class="input-group">
                                                <select name="status_bap" id="status_bap" class="form-control" required>
                                                    <option value="">Status BAP</option>
                                                    <?php foreach ($statusBap as $status) : ?>
                                                        <option value="<?= $status["id"] ?>"><?= $status["status_bap"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fa fa-search"> Cari BAP</i></button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>
                        <button type="button" class="btn btn-inline btn-outline-dark btn-xs mb-3" id="modal-save" data-toggle="modal" data-target="#tambah-bap"> <i class="fa fa-plus"></i> Input No Bap </button>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr align="center">
                                    <th>No </th>
                                    <th>No Bap</th>
                                    <th>Unit / Regu</th>
                                    <th>Nama Petugas</th>
                                    <th>Jenis BAP</th>
                                    <th>Status BAP</th>
                                    <th>Tanggal BAP Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (10 * ($currentPage - 1));
                                if (count($noBap) > 0) :
                                    foreach ($noBap as $noBap) : ?>
                                        <tr>
                                            <td><?= $no++ ?>.</td>
                                            <td><?= $noBap["noBap"]; ?></td>
                                            <td><?= $noBap["unit_penindak"]; ?></td>
                                            <td><?= $noBap["nama_petugas"]; ?></td>
                                            <td><?= $noBap["jenis_bap"]; ?></td>
                                            <td><?= $noBap["status_bap"]; ?></td>
                                            <td><?= date('d F Y', strtotime($noBap["created_at"])); ?></td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <button type="button" class="btn btn-inline btn-outline-warning btn-xs mb-3 edit" data-toggle="modal" data-target="#tambah-bap" data-id="<?= $noBap["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                <button class="btn btn-inline btn-outline-danger btn-xs mb-3 delete" data-toggle="modal" data-target="#delete-bap" data-id="<?= $noBap["id"] ?>"> <i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8" align="center"> Tidak Ada Data</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                        <br>
                        <?= $pager->links('bap', 'custom_pagination'); ?>
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
<div class="modal fade" id="tambah-bap">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> No BAP </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" id="registerBap">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="jenis_bap_id">Jenis BAP :</label>
                        <select name="jenis_bap_id" id="jenis_bap_id" class="form-control">
                            <option value="">-- Silahkan Pilih --</option>
                            <?php foreach ($jenis_bap as $jenis_bap) : ?>
                                <option value="<?= $jenis_bap["id"] ?>"><?= $jenis_bap["jenis_bap"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger" id="errorJenisBap"></small>
                    </div>
                    <div class="form-group">
                        <label for="noBap">Nomor Bap :</label>
                        <input type="number" name="noBap" id="noBap" class="form-control" placeholder="Masukan No Bap ">
                        <small class="text-danger" id="errorBap"></small>
                    </div>
                    <div class="form-group">
                        <label for="noBapAkhir">No Bap Akhir :</label>
                        <input type="number" name="noBapAkhir" id="noBapAkhir" class="form-control" placeholder="Masukan No Bap Akhir">
                        <small class="text-danger" id="errorAkhir"></small>
                    </div>
                    <div class="form-group">
                        <label for="unit_id">Unit / Regu :</label>
                        <select name="unit_id" id="unit_id" class="form-control">
                            <option value="">-- Silahkan Pilih --</option>
                            <?php foreach ($unitPenindak as $unitPenindak) : ?>
                                <option value="<?= $unitPenindak["id"] ?>"><?= $unitPenindak["unit_penindak"] ?></option>
                            <?php endforeach ?>
                        </select>
                        <small class="text-danger" id="errorUnit"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_petugas">Nama Petugas :</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" placeholder="Masukan Nama Petugas" style="text-transform: capitalize;">
                        <small class="text-danger" id="errorPetugas"></small>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark tambah"> <i class="fa fa-check"></i> Simpan</button>
                        <button type="submit" class="btn btn-outline-dark update"> <i class="fa fa-check"></i> Update </button>
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
<div class="modal fade" id="delete-bap">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus No BAP </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form autocomplete="on" id="editBap">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id_delete">
                    <div class="form-group">
                        <label for="noBap">Apakah Anda Yakin ? :</label>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark" id="delete"> <i class="fa fa-check"></i> Hapus Data</button>
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
        $("#unit_id").select2({
            theme: 'bootstrap4'
        });
        $("#jenis_bap_id").select2({
            theme: 'bootstrap4'
        });
        $("#status_bap").select2({
            theme: 'bootstrap4'
        });
    })

    $("#modal-save").click(function(e) {
        $("#id").val('');
        $("#noBap").val('');
        $("#noBapAkhir").removeAttr('disabled', 'disabled');
        $("#unit_id").val('');
        $("#nama_petugas").val('');
        $("#jenis_bap_id").val('');
        $(".update").css('display', 'none').attr('disabled', 'disabled');
        $(".tambah").css('display', 'block').removeAttr('disabled', 'disabled');

        $("#noBap").removeClass('is-invalid');
        $("#errorBap").html('');
        $("#noBapAkhir").removeClass('is-invalid');
        $("#errorAkhir").html('');
        $("#unit_id").removeClass('is-invalid');
        $("#errorUnit").html('');
        $("#nama_petugas").removeClass('is-invalid');
        $("#errorPetugas").html('');
        $("#jenis_bap_id").removeClass('is-invalid');
        $("#errorJenisBap").html('');
    });

    $("#registerBap").submit(function(e) {
        e.preventDefault();
        let jenis_bap_id = $("#jenis_bap_id").val();
        let noBap = $("#noBap").val();
        let noBapAkhir = $("#noBapAkhir").val();
        let unit_id = $("#unit_id").val();
        let nama_petugas = $("#nama_petugas").val();
        $.ajax({
            url: 'save/noBap',
            dataType: 'json',
            method: 'post',
            data: {
                noBap: noBap,
                noBapAkhir: noBapAkhir,
                unit_id: unit_id,
                nama_petugas: nama_petugas,
                jenis_bap_id: jenis_bap_id
            },
            beforeSend: function() {
                $(".tambah").html('<i class="fas fa-cog fa-spin"></i>');
                $(".tambah").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".tambah").html('<i class="fa fa-check"></i>Kirim');
                $(".tambah").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.jenis_bap_id) {
                        $("#jenis_bap_id").addClass('is-invalid');
                        $("#errorJenisBap").html(response.error.jenis_bap_id);
                    } else {
                        $("#jenis_bap_id").removeClass('is-invalid');
                        $("#errorJenisBap").html('');
                    }
                    if (response.error.noBap) {
                        $("#noBap").addClass('is-invalid');
                        $("#errorBap").html(response.error.noBap);
                    } else {
                        $("#noBap").removeClass('is-invalid');
                        $("#errorBap").html('');
                    }
                    if (response.error.noBapAkhir) {
                        $("#noBapAkhir").addClass('is-invalid');
                        $("#errorAkhir").html(response.error.noBapAkhir);
                    } else {
                        $("#noBapAkhir").removeClass('is-invalid');
                        $("#errorAkhir").html('');
                    }
                    if (response.error.unit_id) {
                        $("#unit_id").addClass('is-invalid');
                        $("#errorUnit").html(response.error.unit_id);
                    } else {
                        $("#unit_id").removeClass('is-invalid');
                        $("#errorUnit").html('');
                    }
                    if (response.error.nama_petugas) {
                        $("#nama_petugas").addClass('is-invalid');
                        $("#errorPetugas").html(response.error.nama_petugas);
                    } else {
                        $("#nama_petugas").removeClass('is-invalid');
                        $("#errorPetugas").html('');
                    }
                } else if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            }
        });
    });

    $(".edit").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: 'edit/noBap',
            dataType: 'json',
            method: 'get',
            data: {
                id: id
            },
            success: function(response) {
                $("#id").val(response.id);
                $("#jenis_bap_id").val(response.jenis_bap_id).trigger('change');
                $("#noBap").val(response.noBap);
                $("#noBapAkhir").attr('disabled', 'disabled');
                $("#unit_id").val(response.unit_id).trigger('change');

                $("#nama_petugas").val(response.nama_petugas);

                $(".tambah").css('display', 'none').attr('disabled', 'disabled');
                $(".update").css('display', 'block').removeAttr('disabled', 'disabled');

                $("#noBap").removeClass('is-invalid');
                $("#errorBap").html('');
                $("#noBapAkhir").removeClass('is-invalid');
                $("#errorAkhir").html('');
                $("#unit_id").removeClass('is-invalid');
                $("#errorUnit").html('');
                $("#nama_petugas").removeClass('is-invalid');
                $("#errorPetugas").html('');

            }
        });
    });

    $(".update").click(function(e) {
        e.preventDefault();
        let id = $('#id').val();
        let jenis_bap_id = $("#jenis_bap_id").val();
        let noBap = $('#noBap').val();
        let unit_id = $("#unit_id").val();
        let nama_petugas = $("#nama_petugas").val();
        $.ajax({
            url: 'update/noBap',
            dataType: 'json',
            method: 'post',
            data: {
                id: id,
                jenis_bap_id: jenis_bap_id,
                noBap: noBap,
                unit_id: unit_id,
                nama_petugas: nama_petugas
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.jenis_bap_id) {
                        $("#jenis_bap_id").addClass('is-invalid');
                        $("#errorJenisBap").html(response.error.jenis_bap_id);
                    } else {
                        $("#jenis_bap_id").removeClass('is-invalid');
                        $("#errorJenisBap").html('');
                    }
                    if (response.error.noBap) {
                        $("#noBap").addClass('is-invalid');
                        $("#errorBap").html(response.error.noBap);
                    } else {
                        $("#noBap").removeClass('is-invalid');
                        $("#errorBap").html('');
                    }
                    if (response.error.unit_id) {
                        $("#unit_id").addClass('is-invalid');
                        $("#errorUnit").html(response.error.unit_id);
                    } else {
                        $("#unit_id").removeClass('is-invalid');
                        $("#errorUnit").html('');
                    }
                    if (response.error.nama_petugas) {
                        $("#nama_petugas").addClass('is-invalid');
                        $("#errorPetugas").html(response.error.nama_petugas);
                    } else {
                        $("#nama_petugas").removeClass('is-invalid');
                        $("#errorPetugas").html('');
                    }

                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 500)
                }
            }
        });
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: 'edit/noBap',
            dataType: 'json',
            method: 'get',
            data: {
                id: id
            },
            success: function(response) {
                // $("#noBapEdit").val(response.noBap);
                $("#id_delete").val(response.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $('#id_delete').val();
        $.ajax({
            url: 'delete/noBap',
            dataType: 'json',
            method: 'post',
            data: {
                id: id
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setTimeout(() => {
                    location.reload();
                }, 500)
            }
        });
    });
</script>
<?= $this->endSection(); ?>