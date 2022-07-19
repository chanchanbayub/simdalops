<?= $this->extend("auth/template"); ?>
<?= $this->section("content"); ?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Simdalops</b> <br> <span> Dinas Perhubungan </span></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Silahkan Login</p>
            <form id="loginForm">
                <?= csrf_field(); ?>
                <small id="errorUsername" class="text-danger"></small>
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Nama Pengguna" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <small id="errorPassword" class="text-danger"></small>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <small id="errorConfirm" class="text-danger"></small>
                <div class="input-group mb-3">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Konfirmasi Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <small id="errorConfirm" class="text-danger"></small>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block login"> <span class="fa fa-user"></span> Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- <div class="social-auth-links text-center mb-3">
                <p>- ATAU -</p>
                <a href="/register" class="btn btn-block btn-danger">
                    <i class="fa fa-user"></i> Belum Punya Akun ?
                </a>
            </div> -->
            <div class="social-auth-links text-center mb-3">
                <a href="derek/dashboard" class="btn btn-block btn-danger">
                    <i class="fa fa-user"></i> Derek
                </a>
            </div>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        let username = $("#username").val();
        let password = $("#password").val();
        let confirmPassword = $("#confirmPassword").val();

        $.ajax({
            url: 'login/auth',
            type: 'post',
            dataType: 'json',
            data: {
                username: username,
                password: password,
                confirmPassword: confirmPassword
            },
            beforeSend: function() {

                $(".login").html('<i class="fas fa-cog fa-spin"></i>');

            },
            success: function(response) {
                $(".login").html('<i class="fa fa-user"></i> Masuk');
                if (response.error) {
                    if (response.error.username) {
                        $("#username").addClass("is-invalid");
                        $("#errorUsername").html(response.error.username);
                    } else {
                        $("#username").removeClass("is-invalid");
                        $("#errorUsername").html("");
                    }
                    if (response.error.password) {
                        $("#password").addClass("is-invalid");
                        $("#errorPassword").html(response.error.password);
                    } else {
                        $("#password").removeClass("is-invalid");
                        $("#errorPassword").html("");
                    }
                    if (response.error.confirmPassword) {
                        $("#confirmPassword").addClass("is-invalid");
                        $("#errorConfirm").html(response.error.confirmPassword);
                    } else {
                        $("#confirmPassword").removeClass("is-invalid");
                        $("#errorConfirm").html("");
                    }
                } else if (response.success) {
                    // console.log(response.url)
                    Swal.fire({
                        icon: `${response.icon}`,
                        title: `${response.success}`
                    });
                    setTimeout(function() {
                        location.href = `${response.url}`;
                    }, 1000);
                } else if (response.errors) {
                    Swal.fire({
                        icon: `${response.icon}`,
                        title: `${response.errors}`
                    });
                    // $("#confirmPassword").removeClass("is-invalid");
                    // $("#errorConfirm").html("");
                    // $("#password").removeClass("is-invalid");
                    // $("#errorPassword").html("");
                    // $("#username").removeClass("is-invalid");
                    // $("#errorUsername").html("");
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>