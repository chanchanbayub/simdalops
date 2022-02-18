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
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Surat Pengeluaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <form id="formSuratPengeluaran" autocomplete="off" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="bap_id"> Cari No Register BAP :</label>
                                            <select name="bap_id" id="bap_id" class="form-control" style="width: 100%;">
                                                <option value=""> -- Silahkan Pilih -- </option>
                                                <?php foreach ($noBap as $noBap) : ?>
                                                    <option value="<?= $noBap["bap_id"] ?>">0<?= $noBap["noBap"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->

                                        <div class="form-group">
                                            <label for="ukpd_id"> UKPD :</label>
                                            <select name="ukpd_id" id="ukpd_id" class="form-control" style="width: 100%;" data-placeholder="Pilih UKPD">
                                                <option value="">Silahkan Pilih</option>
                                                <?php foreach ($ukpd as $ukpd) : ?>
                                                    <option value="<?= $ukpd["id"] ?>"><?= $ukpd["ukpd"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="errorUkpd" class="text-danger"></small>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="noBap">No Register BAP :</label>
                                            <input type="tel" name="noBap" id="noBap" style="text-transform: capitalize;" class="form-control">
                                            <small id="errorNoBap" class="text-danger"></small>
                                        </div>
                                        <!-- /.form-group -->

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="type_kendaraan_id">Type Kendaraan :</label>
                                                <select name="type_kendaraan_id" id="type_kendaraan_id" class="form-control" style="width: 100%;">
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <?php foreach ($type_kendaraan as $type_kendaraan) : ?>
                                                        <option value="<?= $type_kendaraan["id"] ?>"><?= $type_kendaraan["type_kendaraan"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small id="errorType_kendaraan_id" class="text-danger"></small>
                                            </div>

                                            <div class="form-group">
                                                <label for="nopol"> Nomor Kendaraan :</label>
                                                <input type="text" name="nopol" id="nopol" class="form-control" style="text-transform: uppercase;">
                                                <small id="errorNopol" class="text-danger"></small>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="jenis_pelanggaran">Jenis Pelanggaran :</label>
                                                <input type="text" name="jenis_pelanggaran" id="jenis_pelanggaran" class="form-control" style="text-transform: capitalize;">
                                                <small id="errorJenisPelanggaran" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="lokasi_pelanggaran">Lokasi Pelanggaran :</label>
                                                <input type="text" name="lokasi_pelanggaran" id="lokasi_pelanggaran" class="form-control" style="text-transform: capitalize;">
                                                <small id="errorLokasiPelanggaran" class="text-danger"></small>
                                            </div>
                                            <!-- form-group -->
                                            <div class="form-group">
                                                <label for="tanggal_pelanggaran"> Tanggal Pelanggaran :</label>
                                                <input type="date" name="tanggal_pelanggaran" id="tanggal_pelanggaran" class="form-control">
                                                <small id="errorTanggalPelanggaran" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="pool_id">Pool Penyimpanan :</label>
                                                <select name="pool_id" id="pool_id" class="form-control" data-placeholder="Pilih Pool Penyimpanan" style="width: 100%;">
                                                    <option value="">Silahkan Pilih</option>
                                                    <?php foreach ($poolPenyimpanan as $poolPenyimpanan) : ?>
                                                        <option value="<?= $poolPenyimpanan["id"] ?>"> <?= $poolPenyimpanan["nama_terminal"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small id="errorPool_id" class="text-danger"></small>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="tahun_perakitan">Tahun Perakitan :</label>
                                                <input type="text" name="tahun_perakitan" id="tahun_perakitan" class="form-control">
                                                <small id="errorTahunPerakitan" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_rangka"> Nomor Rangka :</label>
                                                <input type="text" name="nomor_rangka" id="nomor_rangka" class="form-control" style="text-transform: uppercase;">
                                                <small id="errorNomorRangka" class="text-danger"></small>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="nama_pemilik">Nama Pemilik :</label>
                                                <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" style="text-transform: capitalize;">
                                                <small id="errorNamaPemilik" class="text-danger"></small>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="alamat_pemilik">Alamat Pemilik :</label>
                                                <textarea name="alamat_pemilik" id="alamat_pemilik" class="form-control" style="text-transform: capitalize;"></textarea>
                                                <small id="errorAlamatPemilik" class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="catatan">Catatan :</label>
                                                <textarea name="catatan" id="catatan" class="form-control" style="text-transform: capitalize;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="scan_kwitansi_sidang">Kwitansi Sidang :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="scan_kwitansi_sidang" name="scan_kwitansi_sidang" accept="image/jpeg, image/png, image/jpg">
                                                </div>
                                            </div>
                                            <small id="errorKwitansiSidang" class="text-danger"></small>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group" id="pengantar">
                                            <label for="scan_pengantar_sidang">Pengantar Sidang :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="scan_pengantar_sidang" name="scan_pengantar_sidang" accept="image/jpeg, image/png, image/jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="scan_stuk">Stuk / Amprah :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="scan_stuk" name="scan_stuk" accept="image/jpeg, image/png, image/jpg">
                                                </div>
                                            </div>
                                            <small id="errorStuk" class="text-danger"></small>
                                        </div>
                                        <!-- form-group -->
                                        <div class="form-group">
                                            <label for="scan_kartu_pengawasan">Kartu Pengawasan / KPS :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="scan_kartu_pengawasan" name="scan_kartu_pengawasan" accept="image/jpeg, image/png, image/jpg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="surat_pernyataan"> Surat Pernyataan Bermaterai :</label>
                                            <select name="surat_pernyataan" id="surat_pernyataan" class="form-control">
                                                <option value="">Silahkan Pilih</option>
                                                <option value="0">Ya</option>
                                                <option value="1">Tidak</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="surat_permohonan"> Surat Permohonan Bermaterai :</label>
                                            <select name="surat_permohonan" id="surat_permohonan" class="form-control">
                                                <option value="">Silahkan Pilih</option>
                                                <option value="0">Ya</option>
                                                <option value="1">Tidak</option>
                                            </select>
                                        </div>
                                        <!-- form-group -->
                                        <div class="form-group">
                                            <label for="scan_ktp"> Kartu Tanda Penduduk :</label>
                                            <select name="scan_ktp" id="scan_ktp" class="form-control">
                                                <option value="">Silahkan Pilih</option>
                                                <option value="0">Ya</option>
                                                <option value="1">Tidak</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <!-- form-group -->
                                        <div class="form-group">
                                            <label for="scan_stnk"> STNK :</label>
                                            <select name="scan_stnk" id="scan_stnk" class="form-control">
                                                <option value="">Silahkan Pilih</option>
                                                <option value="0">Ya</option>
                                                <option value="1">Tidak</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- col -->
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="rekomendasiAproval"> Rekomendasi Approval :</label>
                                            <select name="rekomendasiAproval" id="rekomendasiAproval" class="form-control">
                                                <option value="">Silahkan Pilih</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="catatan"> Catatan :</label>
                                            <input type="text" name="catatan" id="catatan" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="noSSRD">Nomor SSRD :</label>
                                            <input type="text" name="noSSRD" id="noSSRD" class="form-control">
                                        </div>

                                    </div> -->
                                    <!-- col -->
                                    <div class="col-12 text-right">
                                        <button class="btn btn-outline-danger" type="reset"> <i class="fa fa-times"></i> Reset</button>
                                        <button class="btn btn-outline-secondary save" type="submit"> <i class="fa fa-check"></i> Ajukan Permohonan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.row -->

<!-- /.container-fluid -->

<!-- /.content -->


<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#ukpd_id").select2({
            theme: 'bootstrap4'
        });
        $("#pool_id").select2({
            theme: 'bootstrap4'
        });
        $("#bap_id").select2({
            theme: 'bootstrap4'
        });
        $("#type_kendaraan_id").select2({
            theme: 'bootstrap4'
        })

    });

    $("#bap_id").change(function(e) {
        e.preventDefault();
        let bap_id = $(this).val();
        console.log(bap_id);
        $.ajax({
            url: '/operator/getNoBap',
            dataType: 'json',
            data: {
                bap_id: bap_id
            },
            method: 'post',
            success: function(response) {
                console.log(response);
                $("#noBap").val('0' + response.noBap);
                $("#ukpd_id").val(response.ukpd_id).trigger('change')
                $("#type_kendaraan_id").val(response.kendaraan_id).trigger('change')
                $("#nopol").val(response.nopol)

                $('#jenis_pelanggaran').val(response.keterangan);
                $('#lokasi_pelanggaran').val(response.lokasi_pelanggaran);
                $('#tanggal_pelanggaran').val(response.tanggal_penindakan);
                $('#pool_id').val(response.pool_id).trigger('change');
                $('#tahun_perakitan').val(response.tahun_perakitan);
                $('#nomor_rangka').val(response.nomor_rangka);
                $('#nama_pemilik').val(response.nama_pemilik);
                $('#alamat_pemilik').val(response.alamat_pemilik);
            }
        })

    });


    $("#formSuratPengeluaran").submit(function(e) {
        e.preventDefault();

        let bap_id = $("#bap_id").val();
        let ukpd_id = $('#ukpd_id').val();
        let noBap = $('#noBap').val();
        let type_kendaraan_id = $('#type_kendaraan_id').val();
        let nopol = $('#nopol').val();
        let jenis_pelanggaran = $('#jenis_pelanggaran').val();
        let lokasi_pelanggaran = $('#lokasi_pelanggaran').val();
        let tanggal_pelanggaran = $('#tanggal_pelanggaran').val();
        let pool_id = $('#pool_id').val();
        let tahun_perakitan = $('#tahun_perakitan').val();
        let nomor_rangka = $('#nomor_rangka').val();
        let nama_pemilik = $('#nama_pemilik').val();
        let alamat_pemilik = $('#alamat_pemilik').val();

        let catatan = $("#catatan").val();

        let scan_kwitansi_sidang = $('#scan_kwitansi_sidang').val();
        let scan_pengantar_sidang = $('#scan_pengantar_sidang').val();
        let scan_stuk = $("#scan_stuk").val();
        let scan_kartu_pengawansan = $("#scan_kartu_pengawasan").val();
        let surat_pernyataan = $("#surat_pernyataan").val();
        let surat_permohonan = $("#surat_permohonan").val();
        let scan_ktp = $("#scan_ktp").val();
        let scan_stnk = $("#scan_stnk").val();


        let formData = new FormData(this);

        formData.append('bap_id', bap_id);
        formData.append('ukpd_id', ukpd_id);
        formData.append('noBap', noBap);
        formData.append('type_kendaraan_id', type_kendaraan_id);
        formData.append('nopol', nopol);
        formData.append('jenis_pelanggaran', jenis_pelanggaran);
        formData.append('lokasi_pelanggaran', lokasi_pelanggaran);
        formData.append('tanggal_pelanggaran', tanggal_pelanggaran);
        formData.append('pool_id', pool_id);
        formData.append('tahun_perakitan', tahun_perakitan);
        formData.append('nomor_rangka', nomor_rangka);
        formData.append('nama_pemilik', nama_pemilik);
        formData.append('alamat_pemilik', alamat_pemilik);
        formData.append('catatan', catatan);

        formData.append('scan_kwitansi_sidang', scan_kwitansi_sidang);
        formData.append('scan_pengantar_sidang', scan_pengantar_sidang);
        formData.append('scan_stuk', scan_stuk);
        formData.append('scan_kartu_pengawasan', scan_kartu_pengawansan);
        formData.append('surat_pernyataan', surat_pernyataan);
        formData.append('surat_permohonan', surat_permohonan);
        formData.append('scan_ktp', scan_ktp);
        formData.append('scan_stnk', scan_stnk);

        $.ajax({
            url: '/operator/saveSurat',
            dataType: 'json',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            beforeSend: function() {
                $(".save").html('<i class="fas fa-spinner fa-pulse"> </i> ')
            },
            success: function(response) {
                console.log(response);
                $(".save").html('<i class="fa fa-check"></i> Ajukan Permohonan');
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#errorUkpd").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#errorUkpd").html('');
                    }
                    if (response.error.noBap) {
                        $("#noBap").addClass('is-invalid');
                        $("#errorNoBap").html(response.error.noBap);
                    } else {
                        $("#noBap").removeClass('is-invalid');
                        $("#errorNoBap").html('');
                    }
                    if (response.error.type_kendaraan_id) {
                        $("#type_kendaraan_id").addClass('is-invalid');
                        $("#errorType_kendaraan_id").html(response.error.type_kendaraan_id);
                    } else {
                        $("#type_kendaraan_id").removeClass('is-invalid');
                        $("#errorType_kendaraan").html('');
                    }
                    if (response.error.nopol) {
                        $("#nopol").addClass('is-invalid');
                        $("#errorNopol").html(response.error.nopol);
                    } else {
                        $("#nopol").removeClass('is-invalid');
                        $("#errorNopol").html('');
                    }
                    if (response.error.jenis_pelanggaran) {
                        $("#jenis_pelanggaran").addClass('is-invalid');
                        $("#errorJenisPelanggaran").html(response.error.jenis_pelanggaran);
                    } else {
                        $("#jenis_pelanggaran").removeClass('is-invalid');
                        $("#errorJenisPelanggaran").html('');
                    }
                    if (response.error.lokasi_pelanggaran) {
                        $("#lokasi_pelanggaran").addClass('is-invalid');
                        $("#errorLokasiPelanggaran").html(response.error.lokasi_pelanggaran);
                    } else {
                        $("#jenis_pelanggaran").removeClass('is-invalid');
                        $("#errorLokasiPelanggaran").html('');
                    }
                    if (response.error.tanggal_pelanggaran) {
                        $("#tanggal_pelanggaran").addClass('is-invalid');
                        $("#errorTanggalPelanggaran").html(response.error.tanggal_pelanggaran);
                    } else {
                        $("#tanggal_pelanggaran").removeClass('is-invalid');
                        $("#errorTanggalPelanggaran").html('');
                    }
                    if (response.error.pool_id) {
                        $("#pool_id").addClass('is-invalid');
                        $("#errorPool_id").html(response.error.pool_id);
                    } else {
                        $("#pool_id").removeClass('is-invalid');
                        $("#errorPool_id").html('');
                    }
                    if (response.error.tahun_perakitan) {
                        $("#tahun_perakitan").addClass('is-invalid');
                        $("#errorTahunPerakitan").html(response.error.tahun_perakitan);
                    } else {
                        $("#tahun").removeClass('is-invalid');
                        $("#errorTahunPerakitan").html('');
                    }
                    if (response.error.nomor_rangka) {
                        $("#nomor_rangka").addClass('is-invalid');
                        $("#errorNomorRangka").html(response.error.nomor_rangka);
                    } else {
                        $("#nomor_rangka").removeClass('is-invalid');
                        $("#errorNomorRangka").html('');
                    }
                    if (response.error.nama_pemilik) {
                        $("#nama_pemilik").addClass('is-invalid');
                        $("#errorNamaPemilik").html(response.error.nama_pemilik);
                    } else {
                        $("#nama_pemilik").removeClass('is-invalid');
                        $("#errorNamaPemilik").html('');
                    }
                    if (response.error.alamat_pemilik) {
                        $("#alamat_pemilik").addClass('is-invalid');
                        $("#errorAlamatPemilik").html(response.error.alamat_pemilik);
                    } else {
                        $("#alamat_pemilik").removeClass('is-invalid');
                        $("#errorAlamatPemilik").html('');
                    }
                    if (response.error.scan_kwitansi_sidang) {
                        $("#scan_kwitansi_sidang").addClass('is-invalid');
                        $("#errorKwitansiSidang").html(response.error.scan_kwitansi_sidang);
                    } else {
                        $("#scan_kwitansi_sidang").removeClass('is-invalid');
                        $("#errorKwitansiSidang").html('');
                    }
                } else if (response.success) {
                    Swal.fire({
                        icon: `${response.icon}`,
                        text: `${response.success}`
                    });
                    setInterval(() => {
                        window.location.href = `${response.url}`;
                    }, 500);
                }

            }
        });
    });

    $("#ukpd_id").change(function(e) {
        var ukpd_id = $("#ukpd_id").val();
        $.ajax({
            url: '/operator/getUkpdId',
            type: 'get',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id
            },
            success: function(response) {
                console.log(response.ukpd);
                if (response.ukpd == 'Dalops') {
                    $("#pengantar").css("display", "none");
                } else {
                    $("#pengantar").css("display", "block");
                }
            }
        });
    })
</script>
<?= $this->endSection(); ?>