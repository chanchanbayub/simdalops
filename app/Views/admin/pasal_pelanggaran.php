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
                            <h3 class="card-title">Data Pasal Pelanggaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form method="get" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: capitalize;" name="keyword" id="keyword" placeholder="Masukan Pasal Pelanggaran " autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-pasal"> <i class="fa fa-plus"></i> Tambah Pasal Pelanggaran </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Pasal Pelanggaran </th>
                                        <th>Keterangan </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + (10 * ($currentPage - 1));
                                    if (count($pasal) > 0) :
                                        foreach ($pasal as $pasal) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $pasal["pasal_pelanggaran"] ?></td>
                                                <td><?= $pasal["keterangan"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-xs edit" data-toggle="modal" data-target="#add-pasal" data-id="<?= $pasal["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-inline bg-gradient-danger btn-xs hapus" data-toggle="modal" data-target="#delete-pasal" data-id="<?= $pasal["id"] ?>"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td align="center" colspan="5">Tidak Ada Data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links('pasal_pelanggaran', 'custom_pagination') ?>
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
<div class="modal fade" id="add-pasal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Tambah Pasal Pelanggaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="pasal_pelanggaran" class="col-form-label">Pasal Pelanggaran :</label>
                        <input type="number" name="pasal_pelanggaran" id="pasal_pelanggaran" class="form-control" placeholder="Masukan Pasal Pelanggaran">
                        <small class="text-danger" id="errorPasal"></small>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan :</label>
                        <textarea name="keterangan" id="keterangan" style="text-transform: capitalize;" class="form-control" placeholder="Masukan Keterangan">  </textarea>
                        <small class="text-danger" id="errorKeterangan"></small>
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
<div class="modal fade" id="delete-pasal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Hapus Pasal Pelanggaran</h4>
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
        $(".modal-title").html('Tambah Pasal Pelanggaran');
        $("#id").val('');
        $(".update").css('display', 'none').attr('disabled', 'disabled');
        $(".save").css('display', 'block').removeAttr('disabled', 'disabled');

        $("#pasal_pelanggaran").val('');
        $('#pasal_pelanggaran').removeClass('is-invalid');
        $('#errorPasal').html('');

        $("#keterangan").val('');
        $('#keterangan').removeClass('is-invalid');
        $('#errorKeterangan').html('');
    })

    $(".save").click(function(e) {
        e.preventDefault();
        var pasal_pelanggaran = $("#pasal_pelanggaran").val();
        var keterangan = $("#keterangan").val();

        $.ajax({
            url: "save/pasal_pelanggaran",
            type: 'post',
            dataType: 'json',
            data: {
                pasal_pelanggaran: pasal_pelanggaran,
                keterangan: keterangan,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {
                    if (response.error.pasal_pelanggaran) {
                        $('#pasal_pelanggaran').addClass('is-invalid');
                        $('#errorPasal').html(response.error.pasal_pelanggaran);
                    } else {
                        $('#pasal_pelanggaran').removeClass('is-invalid');
                        $('#errorPasal').html('');
                    }
                    if (response.error.keterangan) {
                        $('#keterangan').addClass('is-invalid');
                        $('#errorKeterangan').html(response.error.keterangan);
                    } else {
                        $('#keterangan').removeClass('is-invalid');
                        $('#errorKeterangan').html('');
                    }

                } else {
                    $("#add-pasal").modal('hide');
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
        $(".modal-title").html('Edit Pasal Pelanggaran');
        $(".save").css('display', 'none');
        $(".save").attr('disabled', 'disabled');
        $(".update").css('display', 'block');
        $.ajax({
            url: 'edit/pasal_pelanggaran',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#pasal_pelanggaran").val(response.pasal_pelanggaran);
                $('#pasal_pelanggaran').removeClass('is-invalid');
                $('#errorPasal').html('');
                $("#keterangan").val(response.keterangan);
                $('#keterangan').removeClass('is-invalid');
                $('#errorKeterangan').html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var pasal_pelanggaran = $("#pasal_pelanggaran").val();
        var keterangan = $("#keterangan").val();
        $.ajax({
            url: 'update/pasal_pelanggaran',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                pasal_pelanggaran: pasal_pelanggaran,
                keterangan: keterangan,
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

    $(".hapus").click(function(e) {
        e.preventDefault();
        $(".modal-title").html('Hapus Pasal Pelanggaran');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/pasal_pelanggaran',
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
            url: 'delete/pasal_pelanggaran',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i>')
            },
            success: function(response) {
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