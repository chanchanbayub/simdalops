<?= $this->extend("auth/template"); ?>

<?= $this->section("content"); ?>
<div class="register-box">
    <div class="login-logo">
        <p href="#"><b>Simdalops</b> <br> <span> Dinas Perhubungan </span></p>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Daftar Pengguna Baru</p>

            <form id="register" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <select name="ukpd_id" id="ukpd_id" class="form-control">
                        <option value="">Silahkan Pilih</option>
                        <?php foreach ($ukpd as $ukpd) : ?>
                            <option value="<?= $ukpd["id"] ?>"><?= $ukpd["ukpd"] ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <small id="errorUKPD" class="text-danger"></small>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Lengkap UKPD" readonly>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <select name="role_id" id="role_id" class="form-control">
                        <option value="">Silahkan Pilih</option>
                        <?php foreach ($role as $role) : ?>
                            <option value="<?= $role["id"] ?>"><?= $role["role_management"] ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <small id="errorRole" class="text-danger"></small>
                </div>
                <div class="input-group mb-3">
                    <input type="text" autocomplete="off" class="form-control" name="username" id="username" placeholder="Masukan Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <small id="errorUsername" class="text-danger"></small>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <small id="errorPassword" class="text-danger"></small>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Masukan Ulang Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <small id="errorConfirm" class="text-danger"></small>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block register"> <span class="fa fa-user"></span> Daftar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- ATAU -</p>
                <a href="/" class="btn btn-block btn-danger">
                    <i class="fa fa-user"></i>
                    Sudah Punya Akun ?
                </a>
            </div>

        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $("#ukpd_id").change(function(e) {
        var ukpd_id = $(this).val();
        e.preventDefault();
        $.ajax({
            url: 'getUkpd',
            type: 'GET',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id
            },
            success: function(response) {
                if (response == null) {
                    $("#name").val('');
                } else {
                    $("#name").val(response.nama_dinas);
                }
            }
        })
    });

    $("#register").submit(function(e) {
        e.preventDefault();
        let ukpd_id = $("#ukpd_id").val();
        let role_id = $("#role_id").val();
        let username = $("#username").val();
        let password = $("#password").val();
        let confirmPassword = $("#confirmPassword").val();
        $.ajax({
            url: 'save/auth',
            type: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                role_id: role_id,
                username: username,
                password: password,
                confirmPassword: confirmPassword
            },
            beforeSend: function(e) {
                e.preventDefault;
                $(".register").html("<i class='fas fa-circle-notch fa-spin'></i>");
            },
            success: function(response) {
                $(".register").html('<span class="fa fa-user"></span> Daftar')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass("is-invalid");
                        $("#errorUKPD").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#errorUKPD").html('');
                    }
                    if (response.error.role_id) {
                        $("#role_id").addClass("is-invalid");
                        $("#errorRole").html(response.error.role_id);
                    } else {
                        $("#role_id").removeClass('is-invalid');
                        $("#errorRole").html('');
                    }
                    if (response.error.username) {
                        $("#username").addClass("is-invalid");
                        $("#errorUsername").html(response.error.username);
                    } else {
                        $("#username").removeClass('is-invalid');
                        $("#errorUsername").html('');
                    }
                    if (response.error.password) {
                        $("#password").addClass("is-invalid");
                        $("#errorPassword").html(response.error.password);
                    } else {
                        $("#password").removeClass('is-invalid');
                        $("#errorPassword").html('');
                    }
                    if (response.error.confirmPassword) {
                        $("#confirmPassword").addClass("is-invalid");
                        $("#errorConfirm").html(response.error.confirmPassword);
                    } else {
                        $("#confirmPassword").removeClass('is-invalid');
                        $("#errorConfirm").html('');
                    }
                } else if (response.success) {
                    $("#ukpd_id").val('');
                    $("#role_id").val('');
                    $("#username").val('');
                    $("#name").val('');
                    $("#password").val('');
                    $("#confirmPassword").val('');

                    Swal.fire({
                        title: `${response.success}`,
                        icon: 'success',
                        html: 'Silahkan Hubungi Admin Untuk Mengaktifkan Akun! <br> Halaman Ini redirect Otomatis dalam 3 detik',

                    });
                    setInterval(function() {
                        document.location.href = '/'
                    }, 3000)
                }
            }
        })

    })
</script>
<?= $this->endSection(); ?>