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

            <div class="social-auth-links text-center mb-3">
                <p>- ATAU -</p>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-search"></i> Cari Data</button>
            </div>
            <div class="social-auth-links text-center mb-3">
                <p>- ATAU -</p>
                <a href="/derek/dashboard" class=" btn btn-block btn-danger">
                    <i class="fa fa-user"></i> Derek
                </a>
            </div>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">No Register / No BAP / No Kendaraan:</label>
                        <input type="text" class="form-control" id="keyword" name="keyword">
                        <p>Contoh 00001 / B 1234 AB</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success search">Cari Data</button>
                    </div>
                </form>
                <table class="table table-bordered" style="display: none; overflow: auto;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No BAP</th>
                            <th scope="col">Nama Pelanggar</th>
                            <th scope="col">Alamat Pelanggar</th>
                            <th scope="col">Nopol</th>
                            <th scope="col">Lokasi Pelanggaran</th>
                            <th scope="col">Pool Penyimpanan</th>
                            <th scope="col">Foto</th>
                        </tr>
                    </thead>
                    <tbody id="show">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
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

    $(".search").click(function(e) {
        e.preventDefault();
        let keyword = $("#keyword").val();
        $.ajax({
            url: '/derek/search',
            type: 'post',
            dataType: 'json',
            data: {
                keyword: keyword
            },
            beforeSend: function() {
                $(".search").html('<i class="fas fa-cog fa-spin"></i>');
            },
            success: function(response) {
                console.log(response);

                $(".search").html('<i class="fa fa-search"></i> Cari Data');
                if (response != null) {
                    $('.table').css('display', 'inline-block');
                    let table_data = '';

                    table_data += `<tr> 
                        <td> 1. </td>
                        <td> ${response.noBap} </td>
                        <td> ${response.nama_pelanggar} </td>
                        <td> ${response.alamat_pelanggar} </td>
                        <td> ${response.nopol} </td>
                        <td> jl ${response.lokasi_pelanggaran} </td>
                        <td> ${response.nama_terminal} </td>
                        <td> <img src ='/foto-penindakan/${response.foto}' width='80px'></td>
                    </tr>`;

                    $("#show").html(table_data);
                } else {
                    alert('Data Tidak Ditemukan');
                }
            }
        });
    })
</script>
<?= $this->endSection(); ?>