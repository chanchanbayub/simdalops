<?= $this->extend("layout/template"); ?>
<?= $this->section('content'); ?>

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
                            <h3 class="card-title"> Tambah Penindakan Unit / Regu <?= session('unit_penindak') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="tambah_penindakan">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukpd_id">UKPD :</label>
                                            <input type="text" name="ukpd_id" id="ukpd_id" class="form-control" value="<?= session('ukpd') ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="bap_id" class="col-form-label">No BAP : </label>
                                            <select name="bap_id" id="bap_id" class="form-control">
                                                <option value="">-- Silahkan Pilih --</option>
                                                <?php foreach ($noBap as $noBap) : ?>
                                                    <option value="<?= $noBap["id"] ?>"><?= $noBap["noBap"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="errorBap" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit_id">Unit / Regu :</label>
                                            <select name="unit_id" id="unit_id" class="form-control" disabled>
                                                <?php foreach ($unit_penindak as $unit_penindak) : ?>
                                                    <option value="<?= $unit_penindak["id"] ?>"> <?= $unit_penindak["unit_penindak"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="errorUnit" class="text-danger"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="penindakan_id">Jenis Penindakan :</label>
                                            <select name="penindakan_id" id="penindakan_id" class="form-control">
                                                <option value=""> Silahkan Pilih</option>
                                                <?php foreach ($jenis_penindakan as $penindakan) : ?>
                                                    <option value="<?= $penindakan["id"] ?>"> <?= $penindakan["nama_penindakan"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="errorPenindakan" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="klasifikasi_id">Klasifikasi Kendaraan :</label>
                                            <select name="klasifikasi_id" id="klasifikasi_id" class="form-control">
                                                <option value=""> Silahkan Pilih</option>
                                                <?php foreach ($klasifikasi_kendaraan as $klasifikasi_kendaraan) : ?>
                                                    <option value="<?= $klasifikasi_kendaraan["id"] ?>"> <?= $klasifikasi_kendaraan["nama_kendaraan"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="errorKlasifikasi" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="type_kendaraan_id" class="col-form-label">Type Kendaraan : </label>
                                            <select name="type_kendaraan_id" id="type_kendaraan_id" class="form-control">
                                                <option value=""> -- Silahkan Pilih -- </option>
                                            </select>
                                            <small id="errorKendaraan" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_penindakan">Tanggal Penindakan :</label>
                                            <input type="date" name="tanggal_penindakan" id="tanggal_penindakan" class="form-control">
                                            <small id="errorTanggal" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_sidang">Tanggal Sidang :</label>
                                            <input type="date" name="tanggal_sidang" id="tanggal_sidang" class="form-control">
                                            <small id="errorSidang" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_sidang_id">Lokasi Sidang :</label>
                                            <select name="lokasi_sidang_id" id="lokasi_sidang_id" class="form-control">
                                                <option value=""> -- Silahkan Pilih -- </option>
                                                <?php foreach ($lokasi_sidang as $lokasi_sidang) : ?>
                                                    <option value="<?= $lokasi_sidang["id"] ?>"> <?= $lokasi_sidang["lokasi_sidang"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="errorLokasiSidang" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_penindakan">Jam Penindakan :</label>
                                            <input type="time" name="jam_penindakan" id="jam_penindakan" class="form-control">
                                            <small id="errorJam" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="nopol">No Kendaraan :</label>
                                            <input type="text" name="nopol" id="nopol" style="text-transform: uppercase;" placeholder="Masukan No Kendaraan" class="form-control">
                                            <small id="errorNopol" class="text-danger"></small>
                                            <small class="text-danger" style="font-size: 10px;"> <sup>*</sup> cth: B 1234 ABC </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="pasal_pelanggaran_id"> Pasal Pelanggaran : </label>
                                            <select name="pasal_pelanggaran_id" id="pasal_pelanggaran_id" class="form-control">
                                                <option value=""> -- Silahkan Pilih -- </option>
                                                <?php foreach ($pasal_pelanggaran as $pasal) : ?>
                                                    <option value="<?= $pasal["id"] ?>"> <?= $pasal["pasal_pelanggaran"] ?> - <?= $pasal["keterangan"] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class="text-danger" id="errorPasal"> </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_pelanggaran"> Lokasi Pelanggaran : </label>
                                            <input type="text" name="lokasi_pelanggaran" id="lokasi_pelanggaran" placeholder="Masukan Lokasi Pelanggaran " class="form-control" style="text-transform: capitalize;">
                                            <small class="text-danger" id="errorLokasi"> </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="barang_bukti"> Barang Bukti :</label>
                                            <input type="text" name="barang_bukti" id="barang_bukti" class="form-control" placeholder="Masukan Barang Bukti" style="text-transform: capitalize;">
                                            <small class="text-danger" id="errorBarang_Bukti"> <sup>*</sup> cth: STUK, Kend</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="pool_id"> Pool Penyimpanan :</label>
                                            <select name="pool_id" id="pool_id" class="form-control">
                                                <option value="">-- Silahkan Pilih --</option>
                                            </select>
                                            <small id="errorPool" class="text-danger"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_pelanggar" class="col-form-label">Nama Pelanggar : </label>
                                            <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_pelanggar" name="nama_pelanggar" placeholder="Masukan Nama Pelanggar" style="text-transform: capitalize;">

                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_pelanggar" class="col-form-label">Alamat Pelanggar : </label>
                                            <input type="text" style="text-transform: capitalize;" class="form-control" id="alamat_pelanggar" name="alamat_pelanggar" placeholder="Masukan Alamat Pelanggar" style="text-transform: capitalize;">

                                        </div>
                                        <div class="form-group">
                                            <label for="warna_tnkb">Warna TNKB :</label>
                                            <select name="warna_tnkb" id="warna_tnkb" class="form-control">
                                                <option value=""> Silahkan Pilih</option>
                                                <option value="0"> Hitam</option>
                                                <option value="1"> Kuning</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_perakitan" class="col-form-label">Tahun Perakitan : </label>
                                            <input type="number" style="text-transform: capitalize;" class="form-control" id="tahun_perakitan" name="tahun_perakitan" placeholder="Masukan Tahun Perakitan">

                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_rangka" class="col-form-label">Nomor Rangka : </label>
                                            <input type="text" style="text-transform: uppercase;" class="form-control" id="nomor_rangka" name="nomor_rangka" placeholder="Masukan Nomor Rangka">

                                        </div>

                                        <div class="form-group">
                                            <label for="nama_pemilik" class="col-form-label">Nama Pemilik : </label>
                                            <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Masukan Nama Pemilik">

                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_pemilik" class="col-form-label">Alamat Pemilik : </label>
                                            <input type="text" style="text-transform: capitalize;" class="form-control" id="alamat_pemilik" name="alamat_pemilik" placeholder="Masukan Alamat Pemilik">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_id" class="col-form-label">Status BAP : </label>
                                            <select name="status_id" id="status_id" class="form-control">
                                                <option value=""> -- Silahkan Pilih --</option>
                                                <?php foreach ($status_bap as $status_bap) : ?>
                                                    <option value="<?= $status_bap["id"] ?>"><?= $status_bap["status_bap"] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="catatan" class="col-form-label">Catatan : </label>
                                            <input type="text" style="text-transform: capitalize;" class="form-control" id="catatan" name="catatan" placeholder="Masukan Catatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-form-label">Foto : </label>
                                            <input type="File" class="form-control" id="foto" name="foto">
                                            <small id="errorFoto" class="text-danger"></small>
                                        </div>
                                        <div class=" modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                                            <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

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



<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $("#penindakan_id").select2({
            theme: "bootstrap4",
        });

        $("#bap_id").select2({
            theme: "bootstrap4"
        })

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
        $("#type_kendaraan_id").select2({
            theme: 'bootstrap4'
        });
        $("#status_id").select2({
            theme: 'bootstrap4'
        });

        // Webcam.set({
        //     width: 320,
        //     height: 240,
        //     image_format: 'jpeg',
        //     jpeg_quality: 90
        // });
        // Webcam.attach('#my_camera');

    });

    // function take_snapshot() {

    //     // take snapshot and get image data
    //     Webcam.snap(function(data_uri) {
    //         // display results in page
    //         document.getElementById('my_camera').innerHTML =
    //             '<img src="' + data_uri + '"/>';
    //     });
    // }

    $("#bap_id").change(function(e) {
        let bap_id = $(this).val();

        $.ajax({
            url: '/operator/laporan_penindakan/getBap',
            dataType: 'json',
            data: {
                bap_id: bap_id
            },
            type: 'post',
            success: function(response) {
                $("#unit_id").val(response.unit_id);
            }
        });

    })

    $("#penindakan_id").change(function(e) {
        let id = $(this).val();
        // console.log(id);
        $.ajax({
            url: '/operator/laporan_penindakan/getPool',
            dataType: 'json',
            data: {
                penindakan_id: id
            },
            type: 'post',
            success: function(response) {
                if (id == 1) {
                    $("#barang_bukti").val("Kend");
                } else {
                    $("#barang_bukti").val("");
                }
                let pool_penyimpanan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.pool.length > 0) {
                    $("#pool_id").removeAttr('disabled', 'disabled');
                    response.pool.forEach((e) => {
                        pool_penyimpanan += `<option value="${e.id}"> ${e.nama_terminal} </option>`;
                    });
                } else if (response.pool.length < 1) {
                    $("#pool_id").attr('disabled', 'disabled');
                    pool_penyimpanan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#pool_id").html(pool_penyimpanan);
            }
        });
    });



    $("#klasifikasi_id").change(function(e) {
        let id = $(this).val();
        $.ajax({
            url: '/operator/laporan_penindakan/getTypeKendaraan',
            dataType: 'json',
            data: {
                klasifikasi_id: id
            },
            type: 'post',
            success: function(response) {
                // console.log(response.type_kendaraan);
                let type_kendaraan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.type_kendaraan.length > 0) {
                    $("#type_kendaraan_id").removeAttr('disabled', 'disabled');
                    response.type_kendaraan.forEach((e) => {
                        type_kendaraan += `<option value="${e.id}"> ${e.type_kendaraan} </option>`;
                    });
                    $("#type_kendaraan_id").html(type_kendaraan);
                } else if (response.type_kendaraan.length < 1) {
                    $("#type_kendaraan_id").attr('disabled', 'disabled');
                    type_kendaraan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#type_kendaraan_id").html(type_kendaraan);
            }
        });
    });


    $("#tambah_penindakan").submit(function(e) {
        e.preventDefault();
        let ukpd_id = <?= session('ukpd_id') ?>;

        let bap_id = $("#bap_id").val();
        let status_id = $("#status_id").val();

        let penindakan_id = $("#penindakan_id").val();
        let klasifikasi_id = $("#klasifikasi_id").val();
        let type_kendaraan_id = $("#type_kendaraan_id").val();
        let tanggal_penindakan = $("#tanggal_penindakan").val();
        let jam_penindakan = $("#jam_penindakan").val();
        let tanggal_sidang = $("#tanggal_sidang").val();
        let lokasi_sidang = $("#lokasi_sidang").val();
        let nopol = $("#nopol").val();
        let pasal_pelanggaran_id = $("#pasal_pelanggaran_id").val();
        let lokasi_pelanggaran = $("#lokasi_pelanggaran").val();
        let barang_bukti = $("#barang_bukti").val();

        let pool_id = $("#pool_id").val();
        let nama_pelanggar = $("#nama_pelanggar").val();
        let alamat_pelanggar = $("#alamat_pelanggar").val();
        let warna_tnkb = $("#warna_tnkb").val();
        let tahun_perakitan = $("#tahun_perakitan").val();
        let nomor_rangka = $("#nomor_rangka").val();
        let nama_pemilik = $("#nama_pemilik").val();
        let alamat_pemilik = $("#alamat_pemilik").val();
        let catatan = $("#catatan").val();
        let foto = $("#foto").val();
        // console.log(foto);

        let formData = new FormData(this);
        formData.append('ukpd_id', ukpd_id);
        formData.append('penindakan_id', penindakan_id);
        formData.append('klasifikasi_id', klasifikasi_id);
        formData.append('type_kendaraan_id', type_kendaraan_id);
        formData.append('bap_id', bap_id);
        formData.append('status_id', status_id);
        formData.append('nopol', nopol);
        formData.append('pasal_pelanggaran_id', pasal_pelanggaran_id);
        formData.append('tanggal_penindakan', tanggal_penindakan);
        formData.append('jam_penindakan', jam_penindakan);
        formData.append('barang_bukti', barang_bukti);
        formData.append('warna_tnkb', warna_tnkb);
        formData.append('tahun_perakitan', tahun_perakitan);
        formData.append('nomor_rangka', nomor_rangka);
        formData.append('nama_pemilik', nama_pemilik);
        formData.append('alamat_pemilik', alamat_pemilik);
        formData.append('catatan', catatan);
        formData.append('lokasi_pelanggaran', lokasi_pelanggaran);
        formData.append('tanggal_sidang', tanggal_sidang);
        formData.append('lokasi_sidang', lokasi_sidang);
        formData.append('pool_id', pool_id);
        formData.append('nama_pelanggar', nama_pelanggar);
        formData.append('alamat_pelanggar', alamat_pelanggar);
        formData.append('foto', foto);

        $.ajax({
            url: '/operator/laporan_penindakan/add',
            data: formData,
            dataType: 'json',
            enctype: 'multipart/form-data',
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $(".save").html('<i class="fas fa-cog fa-spin"></i>');
                $(".save").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-check">Simpan</i>');
                $(".save").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.penindakan_id) {
                        $("#penindakan_id").addClass('is-invalid');
                        $("#errorPenindakan").html(response.error.penindakan_id);
                    } else {
                        $("#penindakan_id").removeClass('is-invalid');
                        $("#errorPenindakan").html('');
                    }
                    if (response.error.klasifikasi_id) {
                        $("#klasifikasi_id").addClass('is-invalid');
                        $("#errorKlasifikasi").html(response.error.klasifikasi_id);
                    } else {
                        $("#klasifikasi_id").removeClass('is-invalid');
                        $("#errorKlasifikasi").html('');
                    }
                    if (response.error.type_kendaraan_id) {
                        $("#type_kendaraan_id").addClass('is-invalid');
                        $("#errorKendaraan").html(response.error.type_kendaraan_id);
                    } else {
                        $("#type_kendaraan_id").removeClass('is-invalid');
                        $("#errorKendaraan").html('');
                    }
                    if (response.error.bap_id) {
                        $("#bap_id").addClass('is-invalid');
                        $("#errorBap").html(response.error.bap_id);
                    } else {
                        $("#bap_id").removeClass('is-invalid');
                        $("#errorBap").html('');
                    }
                    if (response.error.nopol) {
                        $("#nopol").addClass('is-invalid');
                        $("#errorNopol").html(response.error.nopol);
                    } else {
                        $("#nopol").removeClass('is-invalid');
                        $("#errorNopol").html('');
                    }
                    if (response.error.pasal_pelanggaran_id) {
                        $("#pasal_pelanggaran_id").addClass('is-invalid');
                        $("#errorPasal").html(response.error.pasal_pelanggaran_id);
                    } else {
                        $("#pasal_pelanggaran_id").removeClass('is-invalid');
                        $("#errorPasal").html('');
                    }
                    if (response.error.lokasi_pelanggaran) {
                        $("#lokasi_pelanggaran").addClass('is-invalid');
                        $("#errorLokasi").html(response.error.lokasi_pelanggaran);
                    } else {
                        $("#lokasi_pelanggaran").removeClass('is-invalid');
                        $("#errorLokasi").html('');
                    }
                    if (response.error.tanggal_penindakan) {
                        $("#tanggal_penindakan").addClass('is-invalid');
                        $("#errorTanggal").html(response.error.tanggal_penindakan);
                    } else {
                        $("#tanggal_penindakan").removeClass('is-invalid');
                        $("#errorTanggal").html('');
                    }
                    if (response.error.jam_penindakan) {
                        $("#jam_penindakan").addClass('is-invalid');
                        $("#errorJam").html(response.error.jam_penindakan);
                    } else {
                        $("#jam_penindakan").removeClass('is-invalid');
                        $("#errorJam").html('');
                    }
                    if (response.error.tanggal_sidang) {
                        $("#tanggal_sidang").addClass('is-invalid');
                        $("#errorSidang").html(response.error.tanggal_sidang);
                    } else {
                        $("#tanggal_sidang").removeClass('is-invalid');
                        $("#errorSidang").html('');
                    }
                    if (response.error.lokasi_sidang_id) {
                        $("#lokasi_sidang_id").addClass('is-invalid');
                        $("#errorLokasiSidang").html(response.error.lokasi_sidang_id);
                    } else {
                        $("#lokasi_sidang_id").removeClass('is-invalid');
                        $("#errorLokasiSidang").html('');
                    }
                    if (response.error.pool_id) {
                        $("#pool_id").addClass('is-invalid');
                        $("#errorPool").html(response.error.pool_id);
                    } else {
                        $("#pool_id").removeClass('is-invalid');
                        $("#errorPool").html('');
                    }
                    if (response.error.foto) {
                        $("#foto").addClass('is-invalid');
                        $("#errorFoto").html(response.error.foto);
                    } else {
                        $("#foto").removeClass('is-invalid');
                        $("#errorFoto").html('');
                    }
                    if (response.error.barang_bukti) {
                        $("#barang_bukti").addClass('is-invalid');
                        $("#errorBarang_Bukti").html(response.error.barang_bukti);
                    } else {
                        $("#barang_bukti").removeClass('is-invalid');
                        $("#errorBarang_Bukti").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        location.href = '/operator/laporan_penindakan';
                    }, 1000);
                    // console.log(response);
                }
            }

        })

    });
</script>
<?= $this->endSection(); ?>