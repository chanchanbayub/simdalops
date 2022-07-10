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
                                        <input type="hidden" name="bap_id" id="bap_id" value="<?= $noBap["id"] ?>">
                                        <div class="form-group">
                                            <label for="ukpd_id"> UKPD : </label>
                                            <input type="text" name="ukpd_id" id="ukpd_id" class="form-control" value="<?= session('ukpd') ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="noBap"> No BAPC :</label>
                                            <input type="text" name="noBap" id="noBap" class="form-control" value="<?= $noBap["noBap"] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="penindakan_id" class="col-form-label">Jenis Penindakan : </label>
                                            <select name="penindakan_id" style="width: 100%;" id="penindakan_id" class="form-control">
                                                <option value=""> -- Silahkan Pilih --</option>
                                                <?php foreach ($jenis_penindakan as $penindakan) : ?>
                                                    <option value="<?= $penindakan["id"] ?>"><?= $penindakan["nama_penindakan"] ?></option>
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
                                            <select name="klasifikasi_id" style="width: 100%;" id="klasifikasi_id" class="form-control" disabled>
                                                <option value=""> -- Silahkan Pilih -- </option>

                                            </select>
                                            <small id="errorKlasifikasi" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="kendaraan_id" class="col-form-label">Type Kendaraan : </label>
                                            <select name="kendaraan_id" style="width: 100%;" id="kendaraan_id" class="form-control" disabled>
                                                <option value="">Silahkan Pilih</option>
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
                                                <?php foreach ($pasal_pelanggaran as $pasal_pelanggaran) : ?>
                                                    <option value="<?= $pasal_pelanggaran["id"] ?>"><?= $pasal_pelanggaran["pasal_pelanggaran"] ?> - <?= $pasal_pelanggaran["keterangan"] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class=" text-danger" id="errorPasal"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi_id">Lokasi Pelanggaran (Provinsi) :</label>
                                            <select name="provinsi_id" style="width: 100%;" id="provinsi_id" class="form-control">
                                                <option value=""> -- Silahkan Pilih -- </option>
                                                <?php foreach ($provinsi as $provinsi) : ?>
                                                    <option value="<?= $provinsi["id"] ?>"><?= $provinsi["provinsi"] ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kota_id">Lokasi Pelanggaran (Kota) :</label>
                                            <select name="kota_id" style="width: 100%;" id="kota_id" class="form-control" disabled>
                                                <option value=""> -- Silahkan Pilih -- </option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan_id">Lokasi Pelanggaran (Kecamatan) :</label>
                                            <select name="kecamatan_id" style="width: 100%;" id="kecamatan_id" class="form-control" disabled>
                                                <option value=""> -- Silahkan Pilih -- </option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan_id">Lokasi Pelanggaran (Kelurahan) :</label>
                                            <select name="kelurahan_id" style="width: 100%;" id="kelurahan_id" class="form-control" disabled>
                                                <option value=""> -- Silahkan Pilih -- </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_pelanggaran">Lokasi Pelanggaran (Nama Jalan) :</label>
                                            <input type="text" name="lokasi_pelanggaran" id="lokasi_pelanggaran" class="form-control" placeholder="Masukan Lokasi Pelanggaran" style="text-transform: capitalize;">
                                            <small class="text-danger" id="errorLokasi"> </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan Nama Gedung, Nama Toko (opsional) :</label>
                                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan Nama Gedung" style="text-transform: capitalize;">
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
                                            <input type="text" style="text-transform: capitalize;" name="nama_pelanggar" id="nama_pelanggar" class="form-control" placeholder="Masukan Nama Pelanggar">
                                            <small class="text-danger" id="errorNamaPelanggar"> </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_pelanggar">Alamat Pelanggar :</label>
                                            <input type="text" style="text-transform: capitalize;" name="alamat_pelanggar" id="alamat_pelanggar" class="form-control" placeholder="Masukan Alamat Pelanggar">
                                            <small class="text-danger" id="errorAlamatPelanggar"> </small>
                                        </div>
                                        <div class=" form-group">
                                            <label for="foto" class="col-form-label">Foto Kendaraan Tampak Depan (Terlihat Nomor Kendaraan) : </label>
                                            <!-- <input type="file" style="text-transform: capitalize;" class="form-control" id="foto" name="foto" capture="camera" accept="image/*"> -->
                                            <input type="file" style="text-transform: capitalize;" class="form-control" id="foto" name="foto" accept="image/*">
                                            <small id="errorFoto" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class=" col-12">
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <a href="/petugas/bap" class="btn btn-outline-success" type="reset"> <i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-outline-secondary save" type="submit"> <i class="fa fa-check"></i> Simpan </button>
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


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="syarat-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Syarat & Ketentuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align:center ;">Disclamer</h3>
                <hr>
                <p style="text-align: justify;">Simdalops tidak bertanggung jawab atas segala kesalahan data yang kendaraan diinputkan. Maka dengan ini saya menyatakan bahwa data kendaraan tersebut benar dan terbukti melakukan pelanggaran sesuai undang undang yang berlaku, dan apabila suatu saat nanti terdapat kekeliruan data, maka simdalops tidak bertanggung jawab terhadap kekeliruan data tersebut. </p>
                <hr>
                <h3 style="text-align:center ;">Kebijakan & Privasi</h3>
                <hr>
                <p style="text-align: justify;">Kami berkomitmen untuk menjaga keamanan dan kerahasiaan data pribadi yang diberikan Pengguna saat mengakses dan menggunakan Platform (“Data Pribadi”). Dalam hal ini, Data Pribadi diberikan oleh Pengguna secara sadar dan tanpa adanya tekanan atau paksaan dari pihak manapun, serta ikut bertanggung jawab penuh dalam menjaga kerahasiaan Data Pribadi tersebut. <br>
                    Simdalops dengan ini menyatakan bahwa Anda telah membaca dan memahami secara penuh konten dan sebab-akibat dari Kebijakan Privasi kami, dan Anda tidak dapat secara paksa mencabut kembali persetujuan Anda yang telah terikat dengan ketentuan-ketentuan dari Kebijakan Privasi kami.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary send">Setujui</button>
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

        $("#jenis_kendaraan_id").select2({
            theme: 'bootstrap4'
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
        $("#kendaraan_id").select2({
            theme: 'bootstrap4'
        });
        $("#provinsi_id").select2({
            theme: 'bootstrap4'
        });
        $("#kota_id").select2({
            theme: 'bootstrap4'
        });
        $("#kecamatan_id").select2({
            theme: 'bootstrap4'
        });
        $("#kelurahan_id").select2({
            theme: 'bootstrap4'
        });
    });

    $("#penindakan_id").change(function(e) {
        let penindakan_id = $(this).val();
        $.ajax({
            url: '/petugas/laporanPenindakan/getPoolPenyimpanan',
            dataType: 'json',
            data: {
                penindakan_id: penindakan_id,
            },
            type: 'post',
            success: function(response) {
                // console.log(response.pool_penyimpanan);
                let pool_penyimpanan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.pool_penyimpanan.length > 0) {
                    $("#pool_id").removeAttr('disabled', 'disabled');
                    response.pool_penyimpanan.forEach((e) => {
                        pool_penyimpanan += `<option value="${e.id}"> ${e.nama_terminal} </option>`;
                    });
                } else {
                    $("#pool_id").attr('disabled', 'disabled');
                    pool_penyimpanan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#pool_id").html(pool_penyimpanan);
            }
        });
    });

    $("#provinsi_id").change(function(e) {
        let id = $(this).val();
        // console.log(id);
        $.ajax({
            url: '/petugas/laporanPenindakan/getKota',
            dataType: 'json',
            data: {
                id: id
            },
            type: 'post',
            success: function(response) {
                // console.log(response)
                let kota = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.length > 0) {
                    $("#kota_id").removeAttr('disabled', 'disabled');
                    response.forEach((e) => {
                        kota += `<option value="${e.id}"> ${e.kabupaten_kota} </option>`;
                    });
                    $("#kota_id").html(kota);
                } else {
                    $("#kota_id").attr('disabled', 'disabled');
                    kota += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#kota_id").html(kota);
            }
        });
    });

    $("#kota_id").change(function(e) {
        let id = $(this).val();

        // console.log(id);
        $.ajax({
            url: '/petugas/laporanPenindakan/getKecamatan',
            dataType: 'json',
            data: {
                id: id
            },
            type: 'post',
            success: function(response) {
                // console.log(response)
                let kecamatan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.length > 0) {
                    $("#kecamatan_id").removeAttr('disabled', 'disabled');
                    response.forEach((e) => {
                        kecamatan += `<option value="${e.id}"> ${e.kecamatan} </option>`;
                    });
                    $("#kecamatan_id").html(kecamatan);
                } else {
                    $("#kecamatan_id").attr('disabled', 'disabled');
                    kecamatan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#kecamatan_id").html(kecamatan);
            }
        });
    });

    $("#kecamatan_id").change(function(e) {
        let id = $(this).val();

        // console.log(id);
        $.ajax({
            url: '/petugas/laporanPenindakan/getKelurahan',
            dataType: 'json',
            data: {
                id: id
            },
            type: 'post',
            success: function(response) {
                // console.log(response)
                let kelurahan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.length > 0) {
                    $("#kelurahan_id").removeAttr('disabled', 'disabled');
                    response.forEach((e) => {
                        kelurahan += `<option value="${e.id}"> ${e.kelurahan} </option>`;
                    });
                    $("#kelurahan_id").html(kelurahan);
                } else {
                    $("#kelurahan_id").attr('disabled', 'disabled');
                    kelurahan += '<option value=""> -- Silahkan Pilih -- </option>';
                }
                $("#kelurahan_id").html(kelurahan);
            }
        });
    });

    $("#jenis_kendaraan_id").change(function(e) {
        let jenis_kendaraan_id = $(this).val();
        $.ajax({
            url: '/petugas/laporanPenindakan/getKlasifikasiKendaraan',
            dataType: 'json',
            data: {
                jenis_kendaraan_id: jenis_kendaraan_id
            },
            type: 'post',
            success: function(response) {
                // console.log(response);
                let klasifikasi_kendaraan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.klasifikasi_kendaraan.length > 0) {
                    $("#klasifikasi_id").removeAttr('disabled', 'disabled');
                    response.klasifikasi_kendaraan.forEach((e) => {
                        klasifikasi_kendaraan += `<option value="${e.id}"> ${e.nama_kendaraan} </option>`;
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
        let klasifikasi_id = $(this).val();
        $.ajax({
            url: '/petugas/laporanPenindakan/getTypeKendaraan',
            dataType: 'json',
            data: {
                klasifikasi_id: klasifikasi_id
            },
            type: 'post',
            success: function(response) {
                let type_kendaraan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.type_kendaraan.length > 0) {
                    $("#kendaraan_id").removeAttr('disabled', 'disabled');
                    response.type_kendaraan.forEach((e) => {
                        type_kendaraan += `<option value="${e.id}"> ${e.type_kendaraan} </option>`;
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

    $("#tambah_penindakan").submit(function(e) {
        e.preventDefault();
        let ukpd_id = <?= session('ukpd_id') ?>;
        let penindakan_id = $("#penindakan_id").val();
        let jenis_kendaraan_id = $("#jenis_kendaraan_id").val();
        let klasifikasi_id = $("#klasifikasi_id").val();
        let kendaraan_id = $("#kendaraan_id").val();
        let noBap = $("#bap_id").val();
        let nopol = $("#nopol").val();
        let pasal_pelanggaran_id = $("#pasal_pelanggaran_id").val();
        let lokasi_pelanggaran = $("#lokasi_pelanggaran").val();
        let tanggal_sidang = $("#tanggal_sidang").val();
        let lokasi_sidang = $("#lokasi_sidang").val();
        let pool_id = $("#pool_id").val();
        let nama_pelanggar = $("#nama_pelanggar").val();
        let alamat_pelanggar = $("#alamat_pelanggar").val();
        let foto = $("#foto").val();

        let provinsi_id = $("#provinsi_id").val();
        let kota_id = $("#kota_id").val();
        let kecamatan_id = $("#kecamatan_id").val();
        let kelurahan_id = $("#kelurahan_id").val();
        let keterangan = $("#keterangan").val();
        // console.log(foto);

        let formData = new FormData(this);
        formData.append('ukpd_id', ukpd_id);
        formData.append('penindakan_id', penindakan_id);
        formData.append('jenis_kendaraan_id', jenis_kendaraan_id);
        formData.append('klasifikasi_id', klasifikasi_id);
        formData.append('kendaraan_id', kendaraan_id);
        formData.append('bap_id', noBap);
        formData.append('nopol', nopol);
        formData.append('pasal_pelanggaran_id', pasal_pelanggaran_id);
        formData.append('lokasi_pelanggaran', lokasi_pelanggaran);
        formData.append('tanggal_sidang', tanggal_sidang);
        formData.append('lokasi_sidang', lokasi_sidang);
        formData.append('pool_id', pool_id);
        formData.append('nama_pelanggar', nama_pelanggar);
        formData.append('alamat_pelanggar', alamat_pelanggar);
        formData.append('foto', foto);
        formData.append('provinsi_id', provinsi_id);
        formData.append('kota_id', kota_id);
        formData.append('kecamatan_id', kecamatan_id);
        formData.append('kelurahan_id', kelurahan_id);
        formData.append('keterangan', keterangan);


        $("#syarat-modal").modal('show');

        $("#syarat-modal").on('click', '.send', function(e) {
            e.preventDefault();
            send(formData);
        })

    });

    function send(formData) {
        // console.log(formData);
        $("#syarat-modal").modal('hide');
        $.ajax({
            url: '/petugas/laporanPenindakan/save',
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
                    if (response.error.jenis_kendaraan_id) {
                        $("#jenis_kendaraan_id").addClass('is-invalid');
                        $("#errorJenisKendaraan").html(response.error.jenis_kendaraan_id);
                    } else {
                        $("#jenis_kendaraan_id").removeClass('is-invalid');
                        $("#errorJenisKendaraan").html('');
                    }
                    if (response.error.klasifikasi_id) {
                        $("#klasifikasi_id").addClass('is-invalid');
                        $("#errorKlasifikasi").html(response.error.klasifikasi_id);
                    } else {
                        $("#klasifikasi_id").removeClass('is-invalid');
                        $("#errorKlasifikasi").html('');
                    }
                    if (response.error.kendaraan_id) {
                        $("#kendaraan_id").addClass('is-invalid');
                        $("#errorKendaraan").html(response.error.kendaraan_id);
                    } else {
                        $("#kendaraan_id").removeClass('is-invalid');
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
                    if (response.error.tanggal_sidang) {
                        $("#tanggal_sidang").addClass('is-invalid');
                        $("#errorTanggalSidang").html(response.error.tanggal_sidang);
                    } else {
                        $("#tanggal_sidang").removeClass('is-invalid');
                        $("#errorTanggalSidang").html('');
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
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setTimeout(function() {
                        location.href = '/petugas/bap';
                    }, 1000);
                    // console.log(response);
                }
            }

        })
    }
</script>
<?= $this->endSection(); ?>