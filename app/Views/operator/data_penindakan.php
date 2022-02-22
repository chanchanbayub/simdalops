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
                <div class="col-md-3 col-md-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa fa-car"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total BAP / Tilang </span>
                            <span class="info-box-number"><?= $totalBap ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-md-6 col-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="far fa fa-parking"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> Total Stop Operasi</span>
                            <span class="info-box-number"><?= $totalSO ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <?= session("nama_dinas") ?> / <?= date('d F Y') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan Keyword Pencarian" autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form method="get" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" style="text-transform: uppercase;" name="tanggal_penindakan" id="tanggal_penindakan">
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <input type="hidden" name="download" id="download" value="<?= $tanggal_filter ?>">
                            <a href="/exportExcel/<?= $tanggal_filter ?>" class="btn btn-outline-secondary btn-xs export"><i class="fa fa-file-excel"></i>Export Excel</a>
                            <a href="/operator/laporan_penindakan/tambah_penindakan" class="btn btn-outline-secondary btn-xs"><i class="fa fa-plus"></i>Tambah Data Penindakan</a>
                            <br><br>
                            <table id="example2" class="table table-responsive table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>UKPD</th>
                                        <th>Unit Penindak</th>
                                        <th>Jenis Penindakan</th>
                                        <th>Nomor BAP</th>
                                        <th>Nomor Kendaraan</th>
                                        <th>Statu BAP</th>
                                        <th>Tanggal Penindakan</th>
                                        <th>Tanggal Sidang</th>
                                        <th>Lokasi Sidang</th>
                                        <th>Foto Penindakan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $no = 1 + (5 * ($currentPage - 1));
                                    if (count($laporanPenindakan) > 0) :
                                        foreach ($laporanPenindakan as $laporanPenindakan) : ?>
                                            <tr>
                                                <td><?= $no++ ?>.</td>
                                                <td><?= $laporanPenindakan["ukpd"] ?></td>
                                                <td><?= $laporanPenindakan["unit_penindak"] ?></td>
                                                <td><?= $laporanPenindakan["nama_penindakan"] ?></td>
                                                <td><?= $laporanPenindakan["noBap"] ?></td>
                                                <td><?= $laporanPenindakan["nopol"] ?></td>
                                                <td><?= $laporanPenindakan["status_bap"] ?></td>
                                                <td><?= date('d M Y', strtotime($laporanPenindakan["tanggal_penindakan"])) ?></td>
                                                <td><?= date('d M Y', strtotime($laporanPenindakan["tanggal_sidang"])) ?></td>
                                                <td><?= $laporanPenindakan["lokasi_sidang"] ?></td>
                                                <td> <img src="/foto-penindakan/<?= $laporanPenindakan["foto"] ?>" width="80px" alt="foto-penindakan"></td>
                                                <td>
                                                    <button class="btn btn-outline-warning btn-xs edit" data-toggle="modal" data-target="#modal-edit" data-id="<?= $laporanPenindakan["id"] ?>"> <i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-outline-danger btn-xs delete-data" data-toggle="modal" data-target="#modal-delete" data-id="<?= $laporanPenindakan["id"] ?>"> <i class="fa fa-trash"></i></button>
                                                    <a href="/operator/laporan_penindakan/detail_data/<?= $laporanPenindakan["id"] ?>" class="btn btn-outline-primary btn-xs view" target="_blank"> <i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td align="center" colspan="12"> Tidak Ada Data </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <?= $pager->links('laporan_penindakan', 'custom_pagination') ?>
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
<!-- Modal Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Lengkapi Data Penindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="laporanPenindakan" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_bap" id="id_bap">
                    <div class="form-group">
                        <label for="ukpd_id">UKPD :</label>
                        <input type="text" name="ukpd_id" id="ukpd_id" class="form-control" value="<?= session('ukpd') ?>" readonly>
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
                        <label for="bap_id" class="col-form-label">No BAP : </label>
                        <input type="number" style="text-transform: capitalize;" class="form-control" id="bap_id" name="bap_id" placeholder="Masukan No BAP" disabled>
                        <small id="errorBap" class="text-danger"></small>
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
                        <small id="errorType" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_penindakan">Tanggal Penindakan :</label>
                        <input type="date" name="tanggal_penindakan" id="tgl_penindakan" class="form-control">
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
                        <input type="time" name="jam_penindakan" id="jam_penindakan" class="form-control" disabled>
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
                        <small id="errorBB" class="text-danger"></small>
                        <small style="font-size: 10px;" class="text-danger"> <sup>*</sup> cth: STUK, Kend</small>
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
                        <small id="errorNamaPelanggar" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="alamat_pelanggar" class="col-form-label">Alamat Pelanggar : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="alamat_pelanggar" name="alamat_pelanggar" placeholder="Masukan Alamat Pelanggar" style="text-transform: capitalize;">
                        <small id="errorAlamatPelanggar" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="warna_tnkb">Warna TNKB :</label>
                        <select name="warna_tnkb" id="warna_tnkb" class="form-control">
                            <option value=""> Silahkan Pilih</option>
                            <option value="0"> Hitam</option>
                            <option value="1"> Kuning</option>
                        </select>
                        <small id="errorTNKB" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="tahun_perakitan" class="col-form-label">Tahun Perakitan : </label>
                        <input type="number" style="text-transform: capitalize;" class="form-control" id="tahun_perakitan" name="tahun_perakitan" placeholder="Masukan Tahun Perakitan">
                        <small id="errorTahun" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nomor_rangka" class="col-form-label">Nomor Rangka : </label>
                        <input type="text" style="text-transform: uppercase;" class="form-control" id="nomor_rangka" name="nomor_rangka" placeholder="Masukan Nomor Rangka">
                        <small id="errorNomorRangka" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="nama_pemilik" class="col-form-label">Nama Pemilik : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Masukan Nama Pemilik">
                        <small id="errorNamaPemilik" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="alamat_pemilik" class="col-form-label">Alamat Pemilik : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="alamat_pemilik" name="alamat_pemilik" placeholder="Masukan Alamat Pemilik">
                        <small id="errorAlamatPemilik" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="catatan" class="col-form-label">Catatan : </label>
                        <input type="text" style="text-transform: capitalize;" class="form-control" id="catatan" name="catatan" placeholder="Masukan Catatan">
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
<!-- /.modal -->

<!-- Modal Tambah -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Delete Data Penindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id_delete">
                    <div class="form-group">
                        <h4>Apakah Anda Yakin ?</h4>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fa fa-window-close"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-dark delete"> <i class=" fa fa-check"></i> Hapus</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script>
    $(document).ready(() => {
        $("#unit_id").select2({
            theme: "bootstrap4"
        });
        $("#penindakan_id").select2({
            theme: "bootstrap4"
        });
        $("#klasifikasi_id").select2({
            theme: "bootstrap4"
        });
        $("#type_kendaraan_id").select2({
            theme: "bootstrap4"
        });
        $("#pool_id").select2({
            theme: "bootstrap4"
        });
        $("#lokasi_sidang_id").select2({
            theme: "bootstrap4"
        });
        $("#pasal_pelanggaran_id").select2({
            theme: "bootstrap4"
        });
    });

    // Ajax Penindakan
    $("#penindakan_id").change(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let penindakan_id = $(this).val();
        $.ajax({
            url: '/operator/laporan_penindakan/getPool',
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                penindakan_id: penindakan_id,
            },
            success: function(response) {
                let optionPoolPenyimpanan = '<option value=""> -- Silahkan Pilih -- </option>';
                if (response.pool.length > 0) {
                    response.pool.forEach((e) => {
                        if (e.id === response.laporanPenindakan.pool_id) {
                            optionPoolPenyimpanan += ` <option value="${e.id}" selected> ${e.nama_terminal}  </option>`;
                        } else {
                            optionPoolPenyimpanan += ` <option value="${e.id}"> ${e.nama_terminal}  </option>`;
                        }
                    });
                } else {
                    $("#pool_id").html(optionPoolPenyimpanan);
                }
                $("#pool_id").html(optionPoolPenyimpanan);
            }
        });
    });

    // Ajax Klasifikasi
    $("#klasifikasi_id").change(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let klasifikasi_id = $(this).val();
        $.ajax({
            url: '/operator/laporan_penindakan/getTypeKendaraan',
            type: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                klasifikasi_id: klasifikasi_id
            },
            success: function(response) {
                let type_kendaraan = '<option value =""> -- Silahkan Pilih -- </option>';
                if (response.type_kendaraan.length > 0) {
                    response.type_kendaraan.forEach((e) => {
                        if (e.id === response.laporanPenindakan.kendaraan_id) {
                            type_kendaraan += `<option value="${e.id}" selected > ${e.type_kendaraan} </option>`;
                        } else {
                            type_kendaraan += `<option value="${e.id}" > ${e.type_kendaraan} </option>`;
                        }
                    });
                } else {
                    $("#type_kendaraan_id").html(type_kendaraan);
                }
                $("#type_kendaraan_id").html(type_kendaraan);
            }
        })
    });


    $(".edit").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/operator/laporan_penindakan/edit',
            type: 'post',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {
                $("#id").val(response.id);
                $("#unit_id").val(response.unit_penindak);
                $("#bap_id").val(response.noBap);
                $("#tgl_penindakan").val(response.tanggal_penindakan);
                $("#jam_penindakan").val(response.jam_penindakan);
                $("#id_bap").val(response.bap_id);
                $("#penindakan_id").val(response.penindakan_id).trigger("change");
                $("#klasifikasi_id").val(response.klasifikasi_id).trigger("change");
                $("#tanggal_sidang").val(response.tanggal_sidang);
                $("#lokasi_sidang_id").val(response.lokasi_sidang_id).trigger('change');
                $("#nopol").val(response.nopol);
                $("#pasal_pelanggaran_id").val(response.pasal_pelanggaran_id).trigger('change');

                $("#lokasi_pelanggaran").val(response.lokasi_pelanggaran);
                if (response.barang_bukti == null) {
                    if (response.nama_penindakan == "Stop Operasi") {
                        $("#barang_bukti").val("Kend");
                    } else if (response.nama_penindakan == "Tilang") {
                        $("#barang_bukti").val();
                    }
                } else {
                    $("#barang_bukti").val(response.barang_bukti);
                }


                $("#nama_pelanggar").val(response.nama_pelanggar);
                $("#alamat_pelanggar").val(response.alamat_pelanggar);
                $("#warna_tnkb").val(response.warna_tnkb).trigger('change');
                $("#tahun_perakitan").val(response.tahun_perakitan);
                $("#nomor_rangka").val(response.nomor_rangka);
                $("#nama_pemilik").val(response.nama_pemilik);
                $("#alamat_pemilik").val(response.alamat_pemilik);

            }
        });
    });

    $("#laporanPenindakan").submit(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let penindakan_id = $("#penindakan_id").val();
        let klasifikasi_id = $("#klasifikasi_id").val();
        let type_kendaraan_id = $("#type_kendaraan_id").val();
        let tanggal_penindakan = $("#tgl_penindakan").val();
        let tanggal_sidang = $("#tanggal_sidang").val();
        let lokasi_sidang_id = $("#lokasi_sidang_id").val();
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
        // table bap
        // let status_id = $("#status_id").val();
        let id_bap = $("#id_bap").val();
        $.ajax({
            url: "/operator/laporan_penindakan/save",
            type: 'post',
            dataType: 'json',
            data: {

                id: id,
                penindakan_id: penindakan_id,
                klasifikasi_id: klasifikasi_id,
                type_kendaraan_id: type_kendaraan_id,
                tanggal_penindakan: tanggal_penindakan,
                tanggal_sidang: tanggal_sidang,
                lokasi_sidang_id: lokasi_sidang_id,
                nopol: nopol,
                pasal_pelanggaran_id: pasal_pelanggaran_id,
                lokasi_pelanggaran: lokasi_pelanggaran,
                barang_bukti: barang_bukti,
                pool_id: pool_id,
                nomor_rangka: nomor_rangka,
                nama_pelanggar: nama_pelanggar,
                alamat_pelanggar: alamat_pelanggar,
                warna_tnkb: warna_tnkb,
                tahun_perakitan: tahun_perakitan,
                nama_pemilik: nama_pemilik,
                alamat_pemilik: alamat_pemilik,
                // status_id: status_id,
                id_bap: id_bap
            },
            beforeSend: function(e) {
                $('.save').html('<i class="fas fa-spinner fa-pulse"> </i> ');
                $('.save').attr('disabled', 'disabled');
            },
            success: function(response) {

                $(".save").html('<i class="fa fa-check"> </i> Simpan');
                $('.save').removeAttr('disabled', 'disabled');
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
                        $("#errorType").html(response.error.type_kendaraan_id);
                    } else {
                        $("#type_kendaraan_id").removeClass('is-invalid');
                        $("#errorType").html('');
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
                    if (response.error.jam_penindakan) {
                        $("#jam_penindakan").addClass('is-invalid');
                        $("#errorJam").html(response.error.jam_penindakan);
                    } else {
                        $("#jam_penindakan").removeClass('is-invalid');
                        $("#errorJam").html('');
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
                        $("#errorPasal").html('');
                    }
                    if (response.error.barang_bukti) {
                        $("#barang_bukti").addClass('is-invalid');
                        $("#errorBB").html(response.error.barang_bukti);
                    } else {
                        $("#barang_bukti").removeClass('is-invalid');
                        $("#errorBB").html('');
                    }
                    if (response.error.pool_id) {
                        $("#pool_id").addClass('is-invalid');
                        $("#errorPool").html(response.error.pool_id);
                    } else {
                        $("#pool_id").removeClass('is-invalid');
                        $("#errorPool").html('');
                    }

                } else if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        text: `${response.success}`
                    });
                    setInterval(() => {
                        location.reload();
                    }, 1500);
                }
            }
        });
    });

    $(".delete-data").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/operator/laporan_penindakan/edit',
            type: 'post',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_delete").val(response.id);
            }
        });
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();

        $.ajax({
            url: "/operator/laporan_penindakan/delete",
            dataType: 'json',
            method: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(() => {
                    location.reload();
                }, 1500);
            }
        });

    });
</script>
<?= $this->endSection(); ?>