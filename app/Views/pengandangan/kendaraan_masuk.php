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
                        <button type="button" class="btn btn-outline-secondary btn-xs" data-target="#modal-tambah" data-toggle="modal"> <i class="fa fa-plus"></i> Tambah Kendaraan</button>
                        <br><br>
                        <table id="example2" class="table  table-bordered table-responsive  table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Type Kendaraan</th>
                                    <th>Tanggal Penindakan</th>
                                    <th>Nama Terminal</th>
                                    <th>Status Kendaraan</th>
                                    <th>Foto Kendaraan</th>
                                    <th>Nama Pelanggar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (5 * ($currentPage - 1));
                                if (count($pengandangan) > 0) :
                                    foreach ($pengandangan as $pengandangan) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $no++ ?>.</td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["nopol"] ?></td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["type_kendaraan"] ?></td>
                                            <td style="vertical-align: middle;"><?= date('d F Y', strtotime($pengandangan["tanggal_penindakan"]))  ?></td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["nama_terminal"] ?></td>
                                            <td style="vertical-align: middle;"><?= $pengandangan["status_kendaraan"] ?></td>
                                            <td style="vertical-align: middle;"> <img src="/kendaraan/<?= $pengandangan["foto_kendaraan_masuk"] ?>" width="100px" alt=""></td>
                                            <td style="vertical-align: middle;"> <?= ($pengandangan["nama_pelanggar"] == null) ? "-" : $pengandangan["nama_pelanggar"] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8" align="center">Tidak Ada Data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <br>
                        <?= $pager->links('page_pengandangan', 'custom_pagination'); ?>
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

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kendaraan Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="laporan_data_kendaraan" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="bap_id" id="id">
                    <div class="form-group">
                        <label for="ukpd_id">UKPD :</label>
                        <input type="text" name="ukpd_id" id="ukpd_id" class="form-control" value="<?= session('ukpd') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="laporan_penindakan_id">Nomor Kendaraan :</label>
                        <select name="laporan_penindakan_id" id="laporan_penindakan_id" class="form-control">
                            <option value=""> -- Silahkan Pilih -- </option>
                            <?php if (count($laporanPenindakan) > 0) : ?>
                                <?php foreach ($laporanPenindakan as $laporan) : ?>
                                    <option value="<?= $laporan["id"] ?>"> <?= $laporan["nopol"] ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="" disabled> Tidak Ada Data </option>
                            <?php endif; ?>
                        </select>
                        <small id="errorLaporanPenindakan" class="text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="hiddenForm" style="display: none;">
                            <div class="form-group">
                                <label for="type_kendaraan_id" class="col-form-label">Type Kendaraan : </label>
                                <select name="type_kendaraan_id" class="form-control" id="type_kendaraan_id" disabled>
                                    <option value=""> -- Silahkan Pilih -- </option>
                                    <?php foreach ($kendaraan as $kendaraan) : ?>
                                        <option value="<?= $kendaraan["id"] ?>"><?= $kendaraan["type_kendaraan"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="errorType" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="pasal_pelanggaran_id"> Pasal Pelanggaran : </label>
                                <select name="pasal_pelanggaran_id" class="form-control" id="pasal_pelanggaran_id" disabled>
                                    <option value=""> -- Silahkan Pilih -- </option>
                                    <?php foreach ($pasal_pelanggaran as $pasal) : ?>
                                        <option value="<?= $pasal["id"] ?>"><?= $pasal["pasal_pelanggaran"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_pelanggaran"> Lokasi Pelanggaran : </label>
                                <input type="text" name="lokasi_pelanggaran" id="lokasi_pelanggaran" placeholder="Masukan Lokasi Pelanggaran" class="form-control" style="text-transform: capitalize;" disabled>
                                <small class="text-danger" id="errorLokasi"> </small>
                            </div>
                            <div class="form-group">
                                <label for="pool_id"> Pool Penyimpanan :</label>
                                <select name="pool_id" id="pool_id" class="form-control" disabled>
                                    <option value=""><?= session('nama_terminal') ?></option>
                                </select>
                                <small id="errorPool" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="nama_pelanggar" class="col-form-label">Nama Pelanggar : </label>
                                <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_pelanggar" name="nama_pelanggar" placeholder="Masukan Nama Pelanggar" style="text-transform: capitalize;" disabled>
                                <small id="errorNamaPelanggar" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat_pelanggar" class="col-form-label">Alamat Pelanggar : </label>
                                <input type="text" style="text-transform: capitalize;" class="form-control" id="alamat_pelanggar" name="alamat_pelanggar" placeholder="Masukan Alamat Pelanggar" style="text-transform: capitalize;" disabled>
                                <small id="errorAlamatPelanggar" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="foto_kendaraan_masuk" class="col-form-label">Foto Kendaraan Masuk: </label>
                                <input type="file" style="text-transform: capitalize;" class="form-control" id="foto_kendaraan_masuk" name="foto_kendaraan_masuk" accept="image/*">
                                <small id="errorFoto" class="text-danger"></small>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark save"> <i class=" fa fa-check"></i> Simpan</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="/assets/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#laporan_penindakan_id").select2({
            theme: 'bootstrap4'
        });
    })

    $("#laporan_penindakan_id").change(function(e) {
        e.preventDefault();
        let id = $(this).val();
        $.ajax({
            url: '/pengandangan/getPenindakan',
            data: {
                id: id
            },
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                $("#hiddenForm").css('display', 'block');
                $("#type_kendaraan_id").val(response.kendaraan_id).trigger('change');
                $("#pasal_pelanggaran_id").val(response.pasal_pelanggaran_id).trigger('change');
                $("#lokasi_pelanggaran").val(response.lokasi_pelanggaran);
                $("#nama_pelanggar").val(response.nama_pelanggar);
                $("#alamat_pelanggar").val(response.alamat_pelanggar);
                $("#id").val(response.bap_id);
                // console.log(response);
            }
        });
    });

    $("#laporan_data_kendaraan").submit(function(e) {
        e.preventDefault();
        let laporan_penindakan_id = $("#laporan_penindakan_id").val();
        let foto_kendaraan_masuk = $("#foto_kendaraan_masuk").val();
        let bap_id = $("#id").val();

        let formData = new FormData(this);
        formData.append('laporan_penindakan_id', laporan_penindakan_id);
        formData.append('foto_kendaraan_masuk', foto_kendaraan_masuk);

        $.ajax({
            url: '/pengandangan/save',
            type: 'POST',
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
                $(".save").html('<i class="fa fa-check"> Kirim</i>');
                $(".save").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.laporan_penindakan_id) {
                        $("#laporan_penindakan_id").addClass('is-invalid');
                        $("#errorLaporanPenindakan").html(response.error.laporan_penindakan_id);
                    } else {
                        $("#laporan_penindakan_id").removeClass('is-invalid');
                        $("#errorLaporanPenindakan").html('');
                    }
                    if (response.error.foto_kendaraan_masuk) {
                        $("#foto_kendaraan_masuk").addClass('is-invalid');
                        $("#errorFoto").html(response.error.foto_kendaraan_masuk);
                    } else {
                        $("#laporan_penindakan_id").removeClass('is-invalid');
                        $("#errorFoto").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        location.reload();
                    }, 1000);
                }
            }
        });

    });
</script>



<?= $this->endSection(); ?>