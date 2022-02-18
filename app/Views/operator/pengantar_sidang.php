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
                                <div class="col-md-12">
                                    <form method="get" id="search" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <select name="ukpd_id" id="ukpd_id" class="form-control">
                                                <option value="">-- Silahkan Pilih --</option>
                                                <?php foreach ($ukpd as $ukpd) : ?>
                                                    <option value="<?= $ukpd["id"] ?>"> <?= $ukpd["ukpd"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="date" name="tanggal_sidang" id="tanggal_sidang" class="form-control">
                                            <select name="lokasi_sidang_id" id="lokasi_sidang_id" class="form-control">
                                                <option value="">-- Silahkan Pilih --</option>
                                                <?php foreach ($lokasi_sidang as $lokasi_sidang) : ?>
                                                    <option value="<?= $lokasi_sidang["id"] ?>"> <?= $lokasi_sidang["lokasi_sidang"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>
                        <!-- <button type=" button" class="btn btn-inline btn-outline-dark btn-xs mb-3" id="modal-save" data-toggle="modal" data-target="#add-laporan"> <i class="fa fa-plus"></i> Tambah Laporan Harian </button> -->
                        <a href="/exportExcel_DataSidang/1/2022-01-14/2/2" class="btn btn-inline btn-outline-dark btn-xs mb-3 export"> <i class="fa fa-file-excel"></i> Export Pengantar Sidang </a>

                        <table id="example2" class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>No BA</th>
                                    <th>No BAP</th>
                                    <th>Tanggal BAP</th>
                                    <th>Type Kendaraaan</th>
                                    <th>Nama Pelanggar</th>
                                    <th>Alamat</th>
                                    <th>Barang Bukti</th>
                                    <th>Pasal Yang Dilanggar</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="data-sidang">
                                <tr>
                                    <td colspan="10" align="center">Tidak Ada Data</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
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

<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script>
    $(document).ready(function() {
        $("#ukpd_id").select2({
            theme: 'bootstrap4'
        });
        $("#lokasi_sidang_id").select2({
            theme: 'bootstrap4'
        });
        $(".export").hide();
    });

    $("#lokasi_sidang_id").change(function(e) {
        let ukpd_id = $("#ukpd_id").val();
        let tgl_sidang = $("#tanggal_sidang").val();
        let lokasi_sidang_id = $(this).val();
        // console.log(tgl_sidang)
        $(".export").attr("href", "/exportExcel_DataSidang/" + ukpd_id + "/" + tgl_sidang + "/" + lokasi_sidang_id + "");

        $.ajax({
            url: '/operator/laporan_penindakan/getPenindakanByUkpd',
            dataType: 'json',
            method: 'post',
            data: {
                ukpd_id: ukpd_id,
                tanggal_sidang: tgl_sidang,
                lokasi_sidang_id: lokasi_sidang_id
            },
            success: function(response) {
                let table = '';
                let no = 1;
                if (response.length > 0) {
                    response.forEach((e) => {
                        $(".export").show();

                        table += `<tr> 
                            <td> ${no++} . </td>
                            <td>  </td>
                            <td>${e.noBap} </td>
                            <td> ${e.tanggal_penindakan} </td>
                            <td> ${e.type_kendaraan} </td>
                            <td> ${(e.nama_pelanggar == null) ? "" : e.nama_pelanggar } </td>
                            <td> ${(e.alamat_pelanggar == null) ? "" : e.alamat_pelanggar } </td>
                            <td> ${(e.barang_bukti == null) ? "" : e.barang_bukti} </td>
                            <td> ${e.pasal_pelanggaran} </td>
                            <td> ${e.nopol} </td>
                        </tr>`
                    });
                    $("#data-sidang").html(table);
                } else {
                    $(".export").hide();
                    table += `<tr> 
                        <td colspan="10" align="center">Tidak Ada Data </td>
                    </tr>`;
                }
                $("#data-sidang").html(table);
            }
        });
    });

    // $(".export").click((e) => {
    //     e.preventDefault();
    //     let ukpd_id = $("#ukdp_id").val();
    //     let tanggal_sidang = $("#tanggal_sidang").val();
    //     let lokasi_sidag_id = $("#lokasi_sidang_id").val();

    //     $.ajax({
    //         url: '/exportExcel_DataSidang',
    //         dataType: 'json',
    //         type: 'GET',
    //         data: {
    //             ukpd_id: ukpd_id,
    //             tanggal_sidang: tanggal_sidang,
    //             lokasi_sidang_id: lokasi_sidang_id
    //         },
    //         success: function(response) {
    //             console.log('oke');
    //         }
    //     });
    // });
</script>
<?= $this->endSection(); ?>