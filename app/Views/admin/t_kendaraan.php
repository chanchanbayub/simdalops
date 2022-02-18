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
                            <h3 class="card-title">Data Type Kendaraan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-kendaraan"> <i class="fa fa-plus"></i> Tambah Type Kendaraan </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Klasifikasi Kendaraan</th>
                                        <th>Type Kendaraan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + (5 * ($currentPage - 1));

                                    if (count($kendaraan) > 0) :
                                        foreach ($kendaraan as $kendaraan) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $kendaraan["nama_kendaraan"] ?></td>
                                                <td><?= $kendaraan["type_kendaraan"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-xs edit" data-toggle="modal" data-target="#add-kendaraan" data-id="<?= $kendaraan["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-kendaraan" data-id="<?= $kendaraan["id"] ?>" class="btn btn-inline bg-gradient-danger btn-xs delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links("type_kendaraan", "custom_pagination"); ?>
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
<div class="modal fade" id="add-kendaraan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="klasifikasi_id">Klasifikasi Kendaraan</label>
                        <select name="klasifikasi_id" id="klasifikasi_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($k_kendaraan as $k_kendaraan) : ?>
                                <option value="<?= $k_kendaraan["id"] ?>"><?= $k_kendaraan["nama_kendaraan"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorKlasifikasi" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="type_kendaraan" class="col-form-label">Type Kendaraan :</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="type_kendaraan" name="type_kendaraan" placeholder="Masukan Type kendaraan">
                        <small id="errorKendaraan" class="text-danger"></small>
                    </div>
                    <div class="modal-footer justify-content">
                        <button type="submit" class="btn btn-outline-dark save"> <i class="fa fa-check"></i> Simpan</button>
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
<div class="modal fade" id="delete-kendaraan">
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
                    <input type="hidden" name="id_kendaraan" id="id_delete">
                    <label for="">Apakah Anda Yakin ?</label>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-outline-dark delete"> <i class="fa fa-exclamation-triangle"></i> Hapus</button>
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
        $("#klasifikasi_id").select2({
            theme: "bootstrap4"
        });
    })

    $("#modal-save").click(function(e) {
        $(".modal-title").html('Tambah Type Kendaraan');
        $("#id").val('');
        $("#klasifikasi_id").val('');
        $("#klasifikasi_id").removeClass('is-invalid');
        $("#errorKlasifikasi").html('');
        $("#type_kendaraan").val('');
        $("#type_kendaraan").removeClass('is-invalid');
        $("#errorKendaraan").html('');
        $(".update").css('display', 'none').attr('disabled', 'disabled');
        $(".save").css('display', 'block').removeAttr('disabled', 'disabled');

    });

    $(".save").click(function(e) {
        e.preventDefault();
        var klasifikasi_id = $("#klasifikasi_id").val();
        var type_kendaraan = $("#type_kendaraan").val();
        $.ajax({
            url: "save/type_kendaraan",
            type: 'post',
            dataType: 'json',
            data: {
                klasifikasi_id: klasifikasi_id,
                type_kendaraan: type_kendaraan,
            },
            beforeSend: function(e) {
                $(this).html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                $(this).html('<i class="fa fa-check"> </i> Kirim')
                if (response.error) {
                    console.log(response.error);
                    if (response.error.klasifikasi_id) {
                        $("#klasifikasi_id").addClass('is-invalid');
                        $("#errorKlasifikasi").html(response.error.klasifikasi_id);
                    } else {
                        $("#klasifikasi_id").removeClass('is-invalid');
                        $("#errorKlasifikasi").html('');
                    }
                    if (response.error.type_kendaraan) {
                        $("#type_kendaraan").addClass('is-invalid');
                        $("#errorKendaraan").html(response.error.type_kendaraan);
                    } else {
                        $("#type_kendaraan").removeClass('is-invalid');
                        $("#errorKendaraan").html('');
                    }
                } else {
                    $("#add-kendaraan").modal('hide');
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
        $(".modal-title").html('Edit Type Kendaraan');
        $(".update").css('display', 'block').removeAttr('disabled', 'disabled');
        $(".save").css('display', 'none').attr('disabled', 'disabled');
        $.ajax({
            url: 'edit/type_kendaraan',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#klasifikasi_id").val(response.klasifikasi_id);
                $("#klasifikasi_id").removeClass('is-invalid');
                $("#errorKlasifikasi").html('');
                $("#type_kendaraan").val(response.type_kendaraan);
                $("#type_kendaraan").removeClass('is-invalid');
                $("#errorKendaraan").html('');
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var klasifikasi_id = $("#klasifikasi_id").val();
        var type_kendaraan = $("#type_kendaraan").val();
        $.ajax({
            url: 'update/type_kendaraan',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                klasifikasi_id: klasifikasi_id,
                type_kendaraan: type_kendaraan,
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
        $(".modal-title").html('Hapus Type Kendaraan');
        var id = $(this).data('id');
        console.log(id);
        // alert(id);
        $.ajax({
            url: 'edit/type_kendaraan',
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
            url: 'delete/type_kendaraan',
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