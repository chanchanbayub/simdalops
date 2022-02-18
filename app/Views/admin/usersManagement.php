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
                            <h3 class="card-title">Data Users Management</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-inline btn-outline-dark btn-sm mb-3" id="modal-save" data-toggle="modal" data-target="#add-user"> <i class="fa fa-plus"></i> Tambah User </button>

                            <table id="example2" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>UKPD</th>
                                        <th>Role</th>
                                        <th>Usersname</th>
                                        <th>No Hp</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + (10 * ($currentPage - 1));
                                    if (count($usersManagement) > 0) :
                                        foreach ($usersManagement as $user) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $user["ukpd"] ?></td>
                                                <td><?= $user["role_management"] ?></td>
                                                <td><?= $user["username"] ?></td>
                                                <td><?= $user["noHp"] ?></td>
                                                <?php if ($user["status"] == 1) : ?>
                                                    <td>
                                                        <button type="submit" class="btn btn-inline bg-gradient-warning btn-xs update_status" data-status="0" data-id="<?= $user["id"] ?>"> <i class="fa fa-times">Nonaktifkan</i> </button>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <button type="submit" class="btn btn-inline bg-gradient-primary btn-xs update_status" data-status="1" data-id="<?= $user["id"] ?>"> <i class="fa fa-check">Aktifkan</i> </button>
                                                    </td>
                                                <?php endif; ?>
                                                <td>
                                                    <button type="button" class="btn btn-inline bg-gradient-warning btn-xs edit" data-toggle="modal" data-target="#add-user" data-id="<?= $user["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#delete-user" data-id="<?= $user["id"] ?>" class="btn btn-inline bg-gradient-danger btn-xs delete-data"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="10" align="center">Tidak Ada Data</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links('usersManagement', 'custom_pagination'); ?>
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
<div class="modal fade" id="add-user">
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
                        <label for="ukpd_id"> UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($ukpd as $ukpd) : ?>
                                <option value="<?= $ukpd["id"] ?>"><?= $ukpd["ukpd"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorUKPD" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="role_id"> Role :</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($role as $role) : ?>
                                <option value="<?= $role["id"] ?>"><?= $role["role_management"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="errorRole" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username">
                        <small id="errorUsername" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Username">
                        <small id="errorUsername" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="noHp" class="col-form-label">No Hp:</label>
                        <input type="tel" style="text-transform: capitalize;" class="form-control" id="noHp" name="noHp" placeholder="Masukan No Hp">
                        <small id="errorHp" class="text-danger"></small>
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
<div class="modal fade" id="delete-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Hapus Role Management </h4>
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
        $(".modal-title").html('Tambah User');
        $("#id").val('');
        $(".update").css('display', 'none').attr('disabled', 'disabled');
        $(".save").css('display', 'block').removeAttr('disabled', 'disabled');

        $("#ukpd_id").val('').removeClass('is-invalid');
        $("#errorUKPD").html('');

        $("#role_id").val('').removeClass('is-invalid');
        $("#errorRole").html('');

        $("#username").val('').removeClass('is-invalid');
        $("#errorUsername").html('');

        $("#password").val('').removeClass('is-invalid');
        $("#errorPassword").html('');

        $("#noHp").val('').removeClass('is-invalid');
        $("#errorHp").html('');

        $("#status").val('');

    });

    $(".update_status").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let status_id = $(this).data('status');

        $.ajax({
            url: 'update_status/usersManagement',
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                status_id: status_id
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function() {
                    document.location.reload()
                }, 700);
            }
        });
    })

    $(".save").click(function(e) {
        e.preventDefault();
        var ukpd = $("#ukpd_id").val();
        var role = $("#role_id").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var noHp = $("#noHp").val();
        var status = $("#status").val();

        $.ajax({
            url: "save/usersManagement",
            type: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd,
                role_id: role,
                username: username,
                password: password,
                noHp: noHp,
                status: status
            },
            beforeSend: function(e) {
                $(".save").html('<i class="fas fa-spinner fa-pulse"> </i>');
            },
            success: function(response) {
                $(".save").html('<i class=" fa fa-check"></i> Simpan');
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $('#ukpd_id').addClass('is-invalid');
                        $('#errorUKPD').html(response.error.ukpd_id);
                    } else {
                        $('#ukpd_id').removeClass('is-invalid');
                        $('#errorUKPD').html('');
                    }
                    if (response.error.role_id) {
                        $('#role_id').addClass('is-invalid');
                        $('#errorRole').html(response.error.role_id);
                    } else {
                        $('#role_id').removeClass('is-invalid');
                        $('#errorRole').html('');
                    }
                    if (response.error.username) {
                        $('#username').addClass('is-invalid');
                        $('#errorUsername').html(response.error.username);
                    } else {
                        $('#username').removeClass('is-invalid');
                        $('#errorUsername').html('');
                    }
                    if (response.error.password) {
                        $('#password').addClass('is-invalid');
                        $('#errorPassword').html(response.error.password);
                    } else {
                        $('#password').removeClass('is-invalid');
                        $('#errorPassword').html('');
                    }
                    if (response.error.noHp) {
                        $('#noHp').addClass('is-invalid');
                        $('#errorHp').html(response.error.noHp);
                    } else {
                        $('#noHp').removeClass('is-invalid');
                        $('#errorHp').html('');
                    }
                } else {
                    $("#add-user").modal('hide');
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
        $(".modal-title").html('Edit Users Management');
        $(".save").css('display', 'none');
        $(".save").attr('disabled', 'disabled');
        $(".update").css('display', 'block');
        $.ajax({
            url: 'edit/usersManagement',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $("#id").val(response.id);
                $("#ukpd_id").val(response.ukpd_id).removeClass('is-invalid');
                $("#errorUKPD").html('');

                $("#role_id").val(response.role_id).removeClass('is-invalid');
                $("#errorRole").html('');

                $("#username").val(response.username).removeClass('is-invalid');
                $("#errorUsername").html('');

                $("#noHp").val(response.noHp).removeClass('is-invalid');
                $("#errorHp").html('');

                $("#password").val(response.password);
            }
        });
    })

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id").val();
        var ukpd = $("#ukpd_id").val();
        var role = $("#role_id").val();
        var username = $("#username").val();
        var noHp = $("#noHp").val();
        var password = $("#password").val();

        $.ajax({
            url: 'update/usersManagement',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
                ukpd_id: ukpd,
                role_id: role,
                username: username,
                noHp: noHp,
                password: password,
            },
            beforeSend: function(e) {
                $(".save").html('<i class="fas fa-spinner fa-pulse"> </i>');
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
        $(".modal-title").html('Hapus Users Management');
        var id = $(this).data('id');
        $.ajax({
            url: 'edit/usersManagement',
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
        console.log(id);
        $.ajax({
            url: 'delete/usersManagement',
            dataType: 'json',
            type: 'post',
            data: {
                id: id,
            },
            beforeSend: function(e) {
                $('.delete').html('<i class="fas fa-spinner fa-pulse"> </i>')
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
</script>
<?= $this->endSection(); ?>