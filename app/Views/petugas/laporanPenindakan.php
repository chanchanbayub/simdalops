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
                            <h3 class="card-title"> <?= session("nama_dinas") ?> / <?= date('d F Y') ?></h3>
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
                                <tr>
                                    <th>No </th>
                                    <th>No BAPC</th>
                                    <th>Unit Penindak</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Pasal Pelanggaran</th>
                                    <th>Lokasi Pelanggaran</th>
                                    <th>Tanggal Pelanggaran</th>
                                    <th>Jenis Penindakan </th>
                                    <th>Pool Penyimpanan</th>
                                    <th>Foto </th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (5 * ($currentPage - 1));

                                if (count($laporan_penindakan) > 0) :
                                    foreach ($laporan_penindakan as $laporan_penindakan) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $no++ ?>.</td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["noBap"] ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["unit_penindak"] ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["nopol"] ?></td>
                                            <td style="vertical-align: middle;">Pasal <?= $laporan_penindakan["pasal_pelanggaran"] ?></td>
                                            <td style="vertical-align: middle;">Jl <?= $laporan_penindakan["lokasi_pelanggaran"] ?></td>
                                            <td style="vertical-align: middle;"><?= date('d F Y', strtotime($laporan_penindakan["tanggal_penindakan"])) ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["nama_penindakan"] ?></td>
                                            <td style="vertical-align: middle;"><?= $laporan_penindakan["nama_terminal"] ?></td>
                                            <td style="vertical-align: middle; text-align:center"> <img src="/foto-penindakan/<?= $laporan_penindakan["foto"] ?>" width="80px" alt=""> </td>
                                            <td style="vertical-align: middle; text-align:center">
                                                <button type="button" class="btn btn-warning btn-xs btn-edit" data-id="<?= $laporan_penindakan["id"] ?>" data-toggle="modal" data-target="#modal-edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="<?= $laporan_penindakan["id"] ?>" data-toggle="modal" data-target="#modal-delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="/bap/<?= $laporan_penindakan["id"] ?>" class="btn btn-primary btn-xs btn-view">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11" align="center"> Tidak Ada Data </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <br>
                        <?= $pager->links('laporan_penindakan', 'custom_pagination'); ?>
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

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="bap_id" id="bap_id">
                            <div class=" form-group">
                                <label for="ukpd_id"> UKPD : </label>
                                <input type="text" name="ukpd_id" id="ukpd_id" class="form-control" value=" <?= session('ukpd') ?>" readonly>
                            </div>
                            <div class=" form-group">
                                <label for="noBap"> No BAPC :</label>
                                <input type="text" name="noBap" id="noBap" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="penindakan_id" class="col-form-label">Jenis Penindakan : </label>
                                <select name="penindakan_id" style="width: 100%;" id="penindakan_id" class="form-control">
                                    <option value=""> -- Silahkan Pilih --</option>
                                    <?php foreach ($jenis_penindakan as $jenis_penindakan) : ?>
                                        <option value="<?= $jenis_penindakan["id"] ?>"><?= $jenis_penindakan["nama_penindakan"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="errorPenindakan" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kendaran_id" class="col-form-label">Jenis Kendaraan : </label>
                                <select name="jenis_kendaraan_id" style="width: 100%;" id="jenis_kendaraan_id" class="form-control">
                                    <option value=""> -- Silahkan Pilih -- </option>
                                    <?php foreach ($jenis_kendaraan as $jenis_kendaraan) : ?>
                                        <option value="<?= $jenis_kendaraan["id"] ?>"><?= $jenis_kendaraan["jenis_kendaraan"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="errorJenisKendaraan" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="klasifikasi_id" class="col-form-label">Klasifikasi Kendaraan : </label>
                                <select name="klasifikasi_id" style="width: 100%;" id="klasifikasi_id" class="form-control">
                                    <option value=""> -- Silahkan Pilih -- </option>
                                    <?php foreach ($klasifikasi_kendaraan as $kendaraan) : ?>
                                        <option value="<?= $kendaraan["id"] ?>"> <?= $kendaraan["nama_kendaraan"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="errorKlasifikasi" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="kendaraan_id" class="col-form-label">Type Kendaraan : </label>
                                <select name="kendaraan_id" style="width: 100%;" id="kendaraan_id" class="form-control">
                                    <option value="">Silahkan Pilih</option>
                                    <?php foreach ($type_kendaraan as $type_kendaraan) : ?>
                                        <option value="<?= $type_kendaraan["id"] ?>"> <?= $type_kendaraan["type_kendaraan"] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="errorKendaraan" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="nopol">No Kendaraan :</label>
                                <input type="text" name="nopol" id="nopol" style="text-transform: uppercase;" placeholder="cth: B 1289 T" class="form-control">
                                <small class="text-danger" id="errorNopol"> </small>
                            </div>
                            <div class="form-group">
                                <label for="pasal_pelanggaran_id">Pasal Pelanggaran :</label>
                                <select name="pasal_pelanggaran_id" style="width: 100%;" id="pasal_pelanggaran_id" class="form-control">
                                    <option value=""> -- Silahkan Pilih -- </option>
                                    <?php foreach ($pasal_pelanggaran as $pasal) : ?>
                                        <option value="<?= $pasal["id"] ?>"> <?= $pasal["pasal_pelanggaran"] ?> - <?= $pasal["keterangan"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class=" text-danger" id="errorPasal"></small>
                            </div>

                            <div class="form-group">
                                <label for="lokasi_pelanggaran">Lokasi Pelanggaran :</label>
                                <input type="text" name="lokasi_pelanggaran" id="lokasi_pelanggaran" class="form-control" placeholder="Masukan Lokasi Pelanggaran" style="text-transform: capitalize;">
                                <small class="text-danger" id="errorLokasi"> </small>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sidang">Tanggal Sidang :</label>
                                <input type="date" name="tanggal_sidang" id="tanggal_sidang" class="form-control">
                                <small class=" text-danger" id="errorTanggalSidang"> </small>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_sidang_id">Lokasi Sidang :</label>
                                <select name="lokasi_sidang_id" style="width: 100%;" id="lokasi_sidang_id" class="form-control">
                                    <option value=""> -- Silahkan Pilih --</option>
                                    <?php foreach ($lokasi_sidang as $lokasi_sidang) : ?>
                                        <option value="<?= $lokasi_sidang["id"] ?>"><?= $lokasi_sidang["lokasi_sidang"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger" id="errorLokasiSidang"> </small>
                            </div>
                            <div class="form-group">
                                <label for="pool_id">Pool Penyimpanan :</label>
                                <select name="pool_id" style="width: 100%;" id="pool_id" class="form-control" disabled>
                                    <option value=""> -- Silahkan Pilih --</option>
                                </select>
                                <small class="text-danger" id="errorPool"> </small>
                            </div>
                            <div class="form-group">
                                <label for="nama_pelanggar">Nama Pelanggar :</label>
                                <input type="text" name="nama_pelanggar" id="nama_pelanggar" class="form-control" placeholder="Masukan Nama Pelanggar">
                                <small class="text-danger" id="errorNamaPelanggar"> </small>
                            </div>
                            <div class="form-group">
                                <label for="alamat_pelanggar">Alamat Pelanggar :</label>
                                <input type="text" name="alamat_pelanggar" id="alamat_pelanggar" class="form-control" placeholder="Masukan Alamat Pelanggar">
                                <small class="text-danger" id="errorAlamatPelanggar"> </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update">Update Data</button>
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