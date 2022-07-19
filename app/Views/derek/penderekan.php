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
                            <h3 class="card-title"> / <?= date('d F Y') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form method="get" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan No Bap / Nomor Kendaraan" autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                        <h4 class="text-center">Unit / Regu : <?= session('unit_penindak') ?></h4>
                        <table id="example2" class="table  table-bordered table-responsive table-hover">
                            <thead>
                                <tr align="center">
                                    <th>No </th>
                                    <th>Unit Penderekan</th>
                                    <th>No BAPC</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Jenis Kendaran</th>
                                    <th>Warna Kendaran</th>
                                    <th>Foto Penindakan</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($penderekan as $penderekan) : ?>

                                    <tr>
                                        <td style="vertical-align: middle;"> <?= $no++ ?></td>
                                        <td style="vertical-align: middle;"><?= $penderekan["unit_penindak"] ?></td>
                                        <td style="vertical-align: middle;"> <?= $penderekan["noBap"] ?></td>
                                        <td style="vertical-align: middle;"><?= $penderekan["nopol"] ?></td>
                                        <td style="vertical-align: middle;"><?= $penderekan["type_kendaraan"] ?></td>
                                        <td style="vertical-align: middle;"><?= $penderekan["warna_kendaraan"] ?></td>
                                        <td style="vertical-align: middle;"><img src="/foto-penindakan/<?= $penderekan["foto"] ?>" alt="" width="80px" alt=""></td>
                                        <td>
                                            <a href="/bap_derek/<?= $penderekan["id"] ?>" class="btn btn-primary btn-xs btn-view">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="delete_id">
                    <div class="form-group">
                        <h4>Apakah Anda Yakin ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <button type="submit" class="btn btn-danger hapus"><i class="fa fa-trash"></i></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#penindakan_id").select2({
            theme: "bootstrap4",
        });
        $("#klasifikasi_id").select2({
            theme: 'bootstrap4'
        });
        $("#pasal_pelanggaran_id").select2({
            theme: 'bootstrap4'
        });
        $("#lokasi_sidang_id").select2({
            theme: 'bootstrap4'
        });
        $("#pool_id").select2({
            theme: 'bootstrap4'
        });
        $("#jenis_kendaraan_id").select2({
            theme: 'bootstrap4'
        });
        $("#kendaraan_id").select2({
            theme: 'bootstrap4'
        });
    });

    $("#penindakan_id").change(function(e) {
        let penindakan_id = $(this).val();
        let id = $("#id").val();
        $.ajax({
            url: '/petugas/laporanPenindakan/getPoolPenyimpanan',
            dataType: 'json',
            data: {
                id: id,
                penindakan_id: penindakan_id
            },
            type: 'post',
            success: function(response) {
                let pool_penyimpanan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.pool_penyimpanan.length > 0) {
                    $("#pool_id").removeAttr('disabled', 'disabled');
                    response.pool_penyimpanan.forEach((e) => {
                        if (e.id == response.laporanPenindakan.pool_id) {
                            pool_penyimpanan += `<option value="${e.id}" selected> ${e.nama_terminal} </option>`;
                        } else {
                            pool_penyimpanan += `<option value="${e.id}"> ${e.nama_terminal} </option>`;
                        }

                    });
                } else if (response.length < 1) {
                    $("#pool_id").attr('disabled', 'disabled');
                    pool_penyimpanan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#pool_id").html(pool_penyimpanan);
            }
        });
    });

    $("#jenis_kendaraan_id").change(function(e) {
        let id = $("#id").val();
        let jenis_kendaraan_id = $(this).val();
        let klasifikasi_id = $('#klasifikasi_id').val();
        // getTypeKendaraan();
        $.ajax({
            url: '/petugas/laporanPenindakan/getKlasifikasiKendaraan',
            dataType: 'json',
            data: {
                id: id,
                jenis_kendaraan_id: jenis_kendaraan_id,
                klasifikasi_id: klasifikasi_id
            },
            type: 'post',
            success: function(response) {
                console.log(response);
                let klasifikasi_kendaraan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.klasifikasi_kendaraan.length > 0) {
                    $("#klasifikasi_id").removeAttr('disabled', 'disabled');
                    response.klasifikasi_kendaraan.forEach((e) => {
                        if (e.id == response.laporanPenindakan.klasifikasi_id) {
                            klasifikasi_kendaraan += `<option value="${e.id}" selected> ${e.nama_kendaraan} </option>`;
                        } else {
                            klasifikasi_kendaraan += `<option value="${e.id}" > ${e.nama_kendaraan} </option>`;
                        }
                    });
                    $("#klasifikasi_id").html(klasifikasi_kendaraan);
                } else {
                    $("#klasifikasi_id").attr('disabled', 'disabled');
                    klasifikasi_kendaraan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#klasifikasi_id").html(klasifikasi_kendaraan);
            }
        });
    });

    $("#klasifikasi_id").change(function(e) {
        let id = $("#id").val();
        let klasifikasi_id = $(this).val();
        $.ajax({
            url: '/petugas/laporanPenindakan/getTypeKendaraan',
            dataType: 'json',
            data: {
                id: id,
                klasifikasi_id: klasifikasi_id
            },
            type: 'post',
            success: function(response) {
                console.log(response);
                let type_kendaraan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.type_kendaraan.length > 0) {
                    $("#kendaraan_id").removeAttr('disabled', 'disabled');
                    response.type_kendaraan.forEach((e) => {
                        if (e.id == response.laporanPenindakan.kendaraan_id) {
                            type_kendaraan += `<option value="${e.id}" selected> ${e.type_kendaraan} </option>`;
                        } else {
                            type_kendaraan += `<option value="${e.id}"> ${e.type_kendaraan} </option>`;
                        }

                    });
                    $("#kendaraan_id").html(type_kendaraan);
                } else {
                    $("#kendaraan_id").attr('disabled', 'disabled');
                    type_kendaraan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#kendaraan_id").html(type_kendaraan);
            }
        });

    });

    $('.btn-delete').click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/petugas/laporanPenindakan/edit-data',
            type: 'post',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {
                $("#delete_id").val(response.id);
            }
        });
    });

    $(".hapus").click(function(e) {
        e.preventDefault();
        let id = $("#delete_id").val();
        $.ajax({
            url: '/petugas/laporanPenindakan/hapus',
            type: 'post',
            dataType: 'JSON',
            data: {
                id: id
            },
            beforeSend: function() {
                $(".hapus").html('<i class="fas fa-cog fa-spin"></i>');
                $(".hapus").attr('disabled', 'disabled');
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        });
    })

    $('.btn-edit').click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/petugas/laporanPenindakan/edit-data',
            type: 'post',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {
                // console.log(response);
                $("#id").val(response.laporanPenindakan.id);
                $("#bap_id").val(response.laporanPenindakan.bap_id);
                $("#noBap").val(response.laporanPenindakan.noBap);
                $("#unit_id").val(response.laporanPenindakan.unit_penindak);
                $("#lokasi_pelanggaran").val(response.laporanPenindakan.lokasi_pelanggaran);
                $("#penindakan_id").val(response.laporanPenindakan.penindakan_id).trigger("change");
                $("#jenis_kendaraan_id").val(response.laporanPenindakan.jenis_kendaraan_id).trigger("change");
                $("#tanggal_sidang").val(response.laporanPenindakan.tanggal_sidang);
                $("#lokasi_sidang_id").val(response.laporanPenindakan.lokasi_sidang_id).trigger('change');
                $("#nopol").val(response.laporanPenindakan.nopol);
                $("#pasal_pelanggaran_id").val(response.laporanPenindakan.pasal_pelanggaran_id).trigger('change');
                $("#nama_pelanggar").val(response.laporanPenindakan.nama_pelanggar);
                $("#alamat_pelanggar").val(response.laporanPenindakan.alamat_pelanggar);
                $("#kendaraan_id").val(response.laporanPenindakan.kendaraan_id).trigger('change');
            }
        });
    });

    $("#edit-form").submit(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let bap_id = $("#bap_id").val();
        let penindakan_id = $("#penindakan_id").val();
        let jenis_kendaraan_id = $("#jenis_kendaraan_id").val();
        let klasifikasi_id = $("#klasifikasi_id").val();
        let kendaraan_id = $("#kendaraan_id").val();
        let nopol = $("#nopol").val();
        let pasal_pelanggaran_id = $("#pasal_pelanggaran_id").val();
        let lokasi_pelanggaran = $("#lokasi_pelanggaran").val();
        let tanggal_sidang = $("#tanggal_sidang").val();
        let lokasi_sidang_id = $("#lokasi_sidang_id").val();
        let pool_id = $('#pool_id').val();
        let nama_pelanggar = $("#nama_pelanggar").val();
        let alamat_pelanggar = $("#alamat_pelanggar").val();

        let formData = new FormData(this);

        formData.append('id', id);
        formData.append('penindakan_id', penindakan_id);
        formData.append('jenis_kendaraan_id', jenis_kendaraan_id);
        formData.append('klasifikasi_id', klasifikasi_id);
        formData.append('kendaraan_id', kendaraan_id);
        formData.append('bap_id', bap_id);
        formData.append('nopol', nopol);
        formData.append('pasal_pelanggaran_id', pasal_pelanggaran_id);
        formData.append('lokasi_pelanggaran', lokasi_pelanggaran);
        formData.append('tanggal_sidang', tanggal_sidang);
        formData.append('lokasi_sidang_id', lokasi_sidang_id);
        formData.append('pool_id', pool_id);
        formData.append('nama_pelanggar', nama_pelanggar);
        formData.append('alamat_pelanggar', alamat_pelanggar);


        $.ajax({
            url: '/petugas/laporanPenindakan/update',
            data: formData,
            dataType: 'json',
            type: 'POST',
            enctype: 'multipart/form-data',
            processData: false,
            cache: false,
            contentType: false,
            beforeSend: function() {
                $(".update").html('<i class="fas fa-cog fa-spin"></i>');
                $(".update").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-check">Simpan</i>');
                $(".update").removeAttr('disabled', 'disabled');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setTimeout(function() {
                    location.href = '/petugas/laporanPenindakan';
                }, 1000);
            }
        })

    })
</script>

<?= $this->endSection(); ?>