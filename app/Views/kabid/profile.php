<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" href="/assets/signaturepad/jquery.signature.css">
<link rel="stylesheet" href="/assets/signaturepad/jquery.ui.css">


<style>
    .kbw-signature {
        width: 400px;
        height: 200px;
    }
</style>
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
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-secondary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="https://3.bp.blogspot.com/-1aWsvIfu95A/W6XY0r7XX0I/AAAAAAAAD3s/LOn2CDpfLyUniUWAXeTeJ-yHZKUyZP0QACLcBGAs/s1600/dishub.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= session("username") ?></h3>

                            <p class="text-muted text-center"><?= session("role_management") ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nama</b> <a class="float-right"><?= ($profile != null ? "{$profile['namaLengkap']}" : '-') ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>NIP</b> <a class="float-right"><?= ($profile != null ? "{$profile["nip"]}" : '-') ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>UKPD</b> <a class="float-right"><?= session('ukpd') ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Dinas</b> <a class="float-right"><?= session("nama_dinas") ?></a>
                                </li>
                                <li class="list-group-item">
                                    <?php if (session("status") == 1) : ?>
                                        <b>Status</b> <a class="float-right">Active</a>
                                    <?php else : ?>
                                        <b>Status</b> <a class="float-right">Not Active</a>
                                    <?php endif; ?>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-block btn-outline-dark btn-sm mb-3" id="modalProfile" data-toggle="modal" data-target="#editProfile"> <i class="fa fa-edit"></i> Edit Profile </button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->
<!-- Modal Tambah -->
<div class="modal fade" id="editProfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Perbaharui Profile </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" id="form-profile">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="users_id" id="users_id" value="<?= session('id') ?>">
                    <div class="form-group">
                        <label for="namaLengkap">Nama Lengkap :</label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="namaLengkap" name="namaLengkap" placeholder="Masukan Nama Lengkap">
                        <small id="errorNama" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP :</label>
                        <input type="number" style="text-transform: capitalize;" class="form-control" id="nip" name="nip" placeholder="Masukan Nip Anda">
                        <small id="errorNip" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <div id="canva"></div>
                        <div class="text-left">
                            <!-- <button id="disable" type="button" class="btn btn-outline-primary btn-xs"> <i class="fa fa-ban"></i> Disable</button> -->
                            <button id="clear" type="button" class="btn btn-outline-danger btn-xs"> <i class="fa fa-times"></i> Hapus </button>
                            <textarea id="signature64" name="ttd" style="display: none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content">
                        <button type="submit" class="btn btn-outline-dark save"> <i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
                <!-- <canvas class="canvas"></canvas> -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script src="/assets/signaturepad/jquery.ui.min.js"></script>
<script src="/assets/signaturepad/jquery.signature.min.js"></script>
<script src="/assets/signaturepad/jquery.ui.touch-punch.min.js"></script>

<script>
    $('#widget').draggable();

    let signaturePad = $("#canva").signature({
        syncField: '#signature64',
        syncFormat: 'PNG',
        color: '#0000FF',
        // guideline: true
    });

    $('#disable ').click(function() {
        var disable = $(this).text() === 'Disable';
        $(this).text(disable ? ' Enable' : 'Disable');
        signaturePad.signature(disable ? 'Disable' : 'Enable');
    });
    $('#clear').click(function() {
        signaturePad.signature('clear');
    });

    $("#modalProfile").click(function(e) {
        users_id = $('#users_id').val();

        $.ajax({
            url: '/kabid/profile/getProfile/',
            dataType: 'json',
            data: {
                users_id: users_id
            },
            type: 'get',
            success: function(response) {

                if (response != null) {
                    $("#users_id").val(response.users_id).attr('disabled', 'disabled');
                    $("#namaLengkap").val(response.namaLengkap).attr('disabled', 'disabled');
                    $("#nip").val(response.nip).attr('disabled', 'disabled');;
                    $("#canva").html(`<img src="/${response.ttd}" />`);
                    $(".save").attr('disabled', 'disabled');
                }

            }
        })
    })

    $("#form-profile").submit(function(e) {
        e.preventDefault();

        let users_id = $("#users_id").val();
        let namaLengkap = $("#namaLengkap").val();
        let nip = $("#nip").val();
        let ttd = $("#signature64").val();

        $.ajax({
            url: '/kabid/profile/save_profile/',
            dataType: 'JSON',
            data: {
                users_id: users_id,
                namaLengkap: namaLengkap,
                nip: nip,
                ttd: ttd
            },
            type: 'POST',
            success: function(response) {
                if (response.error) {
                    if (response.error.namaLengkap) {
                        $("#namaLengkap").addClass('is-invalid');
                        $("#errorNama").html(response.error.namaLengkap);
                    } else {
                        $("#namaLengkap").removeClass('is-invalid');
                        $("#errorNama").html('');
                    }
                    if (response.error.nip) {
                        $("#nip").addClass('is-invalid');
                        $("#errorNip").html(response.error.nip);
                    } else {
                        $("#nip").removeClass('is-invalid');
                        $("#errorNip").html('');
                    }
                    if (response.error.ttd) {
                        $("#canva").css('border', '1px solid red');
                    } else {
                        $("#canva").css('border', '1px solid black');
                    }
                } else if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        text: `${response.success}`
                    });
                    setInterval(() => {
                        document.location.reload();
                    }, 1000);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>