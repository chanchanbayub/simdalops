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
            <?php if ($pengeluaran["status_surat_id"] == 3) : ?>
                <div class="row">
                    <div class="col-md-6 col-md-6 col-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="far fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cetak SKRD</span>
                                <span class="info-box-text"><a style="color: white;" class="btn btn-outline-secondary" href="/cetak_surat/SKRD/<?= $pengeluaran["id"] ?>" target="_blank"> <i class="fas fa-hand-pointer"></i> Klik Disini!</a></span>

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
                    <div class="col-md-6 col-md-6 col-12">
                        <div class="info-box bg-secondary">
                            <span class="info-box-icon"><i class="far fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cetak Surat Pengeluaran</span>
                                <span class="info-box-text"><a style="color: white;" class="btn btn-outline-primary" href="/surat_pengeluaran/<?= $pengeluaran["id"] ?>" target="_blank"> <i class="fas fa-hand-pointer"></i> Klik Disini!</a></span>

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
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-outline card-secondary  widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-white">
                            <div class="widget-user-image">
                                <h6 class="text-center pb-10">Verifikasi Kelengkapan Berkas <br> Permohonan Pengeluaran Kendaraan</h6>
                                <hr>
                            </div>
                            <h6 class="text-center">Jenis Kendaraan : <?= $pengeluaran["type_kendaraan"] ?></h6>
                            <h6 class="text-center">No. Kendaraan : <?= $pengeluaran["nopol"] ?></h6>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column bg-white">
                                <table class="table bg-white">
                                    <tr>
                                        <td style="width:15px;"> <?= $pengeluaran["ukpd"] ?> </td>
                                        <td> </td>
                                        <td align="center"> <?= $pengeluaran["nama_terminal"] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15px;">1. </td>
                                        <td> Kwitansi Sidang </td>
                                        <td style="width: 20%; text-align:center"> <i class="fa fa-check"></i> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15px;">2. </td>
                                        <td> Surat Permohonan Bermaterai </td>
                                        <?php if ($pengeluaran["surat_permohonan"] == 0) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i></td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 15px;">3. </td>
                                        <td> Surat Pernyataan Bermaterai </td>
                                        <?php if ($pengeluaran["surat_pernyataan"] == 0) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i> </td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px;">4. </td>
                                        <td> STNK Asli / Fotocopy </td>
                                        <?php if ($pengeluaran["scan_stnk"] == 0) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i></td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px;">5. </td>
                                        <td> KP / KPS Asli </td>
                                        <?php if ($pengeluaran["scan_kartu_pengawasan"] !== NULL) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i> </td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px;">6. </td>
                                        <td> Kartu Uji Berkala / Amprah </td>
                                        <?php if ($pengeluaran["scan_stuk"] !== NULL) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i> </td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px;">7. </td>
                                        <td> Surat Pengantar dari Suku Dinas Perhubungan </td>
                                        <?php if ($pengeluaran["scan_pengantar_sidang"] !== NULL) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i> </td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px;">8. </td>
                                        <td> Fotocopy KTP </td>
                                        <?php if ($pengeluaran["scan_ktp"] == 0) : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-check"></i></td>
                                        <?php else : ?>
                                            <td style="width: 20px; text-align:center"> <i class="fa fa-times"></i></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                                <table class="table bg-white">
                                    <tr>
                                        <td style="width: 15%;">Catatan</td>
                                        <td style="width:5%">:</td>
                                        <?php if ($pengeluaran["catatan"] != NULL) : ?>
                                            <td style="width:15px"><?= $pengeluaran["catatan"] ?> </td>
                                        <?php else : ?>
                                            <td style="width:15px"> -</td>
                                        <?php endif ?>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Status Surat</td>
                                        <td style="width:5%">:</td>
                                        <td style="width:15px"> <?= $pengeluaran["name"] ?></td>
                                    </tr>
                                    <tr>
                                        <?php if ($pengeluaran["status_surat_id"] == 2 || $pengeluaran["status_surat_id"] == 3 || $pengeluaran["status_surat_id"] == 4) : ?>
                                            <td style="width: 20%;">Rekomendasi Approval</td>
                                            <td style="width:5%">:</td>
                                            <?php if ($pengeluaran["rekomendasi_approv"] == 0) : ?>
                                                <td style="width:15px"> Ya </td>
                                            <?php elseif ($pengeluaran["rekomendasi_approve"] == "NULL") : ?>
                                                <td style="width:15px"> - </td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tr>
                                    <?php if ($pengeluaran["status_surat_id"] == 2 || $pengeluaran["status_surat_id"] == 3 || $pengeluaran["status_surat_id"] == 4) : ?>
                                        <tr>
                                            <td style="width: 15%;">Catatan Kepala Seksi</td>
                                            <td style="width:5%">:</td>
                                            <td style="width:15px"> <?= $pengeluaran["catatan_lain"] ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                                <table class="table bg-white table-responsive ">
                                    <tr>
                                        <td style="width:15%;"> </td>
                                        <td style="width:15%;">Diterima</td>
                                        <td style="width:15%;">Selesai </td>
                                        <td style="width:15%; text-align:center">Jakarta, <?= date('d F Y', strtotime($pengeluaran["tanggal_pengeluaran"])); ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">1. Pengajuan</td>
                                        <td><?= date('H:i', strtotime($pengeluaran["tanggal_pengeluaran"])) ?></td>
                                        <td></td>
                                        <td style="text-align:center"> Verifikasi</td>
                                    </tr>
                                    <tr>
                                        <td>2. Verifikasi</td>
                                        <td><?= date('H:i', strtotime($pengeluaran["updated_at"])) ?></td>
                                        <td></td>
                                        <?php if ($profil != null) : ?>
                                            <td rowspan="3" align="center"> <img src="/<?= $profil["ttd"] ?> " width="150px" alt=""> </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>3. SKRD</td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td>4. Cetak Surat</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5. Pemohon</td>
                                        <td></td>
                                        <td></td>
                                        <?php if ($profil == null) : ?>
                                            <td colspan="4" style="text-align: center;"> Nama : <br> Nip :</td>
                                        <?php else :  ?>
                                            <td colspan="4" style="text-align: center;"> <?= $profil["namaLengkap"] ?> <br> <?= $profil["nip"] ?></td>
                                        <?php endif; ?>
                                    </tr>

                                </table>
                                <!-- Ceklis Surat -->
                                <table class="table bg-white ">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h4> Data Pelanggaran Kendaraan</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">Jenis Pelanggaran </td>
                                        <td>:</td>
                                        <td style="text-align: left;"><?= $pengeluaran["jenis_pelanggaran"] ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">Lokasi Pelanggaran </td>
                                        <td>:</td>
                                        <td style="text-align: left;"><?= $pengeluaran["lokasi_pelanggaran"] ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">Tanggal Pelanggaran </td>
                                        <td>:</td>
                                        <td style="text-align: left;"><?= date('d F Y', strtotime($pengeluaran["tanggal_pelanggaran"])) ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">Nama Pemilik </td>
                                        <td>:</td>
                                        <td style="text-align: left;"><?= $pengeluaran["nama_pemilik"] ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">Alamat Pemilik </td>
                                        <td>:</td>
                                        <td style="text-align: left;"><?= $pengeluaran["alamat_pemilik"] ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">Berkas Yang Dilampirkan </td>
                                        <td>:</td>
                                        <td style="text-align: left;"><a href="/lihat_gambar/<?= $pengeluaran["id"] ?>" target="_blank"> Lihat Berkas </a></td>
                                    </tr>
                                </table>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
</div>

<script src="/assets/plugins/jquery/jquery.min.js"></script>

<?= $this->endSection(); ?>