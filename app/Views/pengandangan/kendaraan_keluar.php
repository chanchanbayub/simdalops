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
                                            <input type="text" class="form-control" style="text-transform: uppercase;" name="keyword" id="keyword" placeholder="Masukan  Nomor Kendaraan" autofocus>
                                            <button class="btn btn-outline-primary " type="Submit" id="button-addon2"> <i class="fa fa-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
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
                                    <th>Aksi</th>
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
                                            <td style="vertical-align: middle;">
                                                <button type="button" class="btn btn-outline-warning btn-xs edit" data-target="#modal-tambah" data-id="<?= $pengandangan["id"] ?>" data-toggle="modal"> <i class="fa fa-edit"></i> </button>
                                            </td>
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
                <h4 class="modal-title">Konfirmasi Kendaraan Keluar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="laporan_data_kendaraan" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nopol">Nomor Kendaraan :</label>
                        <input type="text" name="nopol" id="nopol" disabled class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="foto_kendaraan_keluar">Foto Kendaraan Keluar :</label>
                        <input type="file" name="foto_kendaraan_keluar" id="foto_kendaraan_keluar" class="form-control" accept="image/*">
                        <small id="errorFoto" class="text-danger"></small>
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

    $(".edit").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: '/pengandangan/edit',
            data: {
                id: id
            },
            dataType: 'JSON',
            type: 'POST',
            success: function(response) {
                $("#id").val(response.id);
                $("#nopol").val(response.nopol);
            }
        });

    });


    $("#laporan_data_kendaraan").submit(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let foto_kendaraan_keluar = $("#foto_kendaraan_keluar").val();

        let formData = new FormData(this);
        formData.append('foto_kendaraan_keluar', foto_kendaraan_keluar);
        formData.append('id', id);

        $.ajax({
            url: '/pengandangan/update',
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
                console.log(response.error);
                if (response.error) {

                    if (response.error.foto_kendaraan_keluar) {
                        $("#foto_kendaraan_keluar").addClass('is-invalid');
                        $("#errorFoto").html(response.error.foto_kendaraan_keluar);
                    } else {
                        $("#foto_kendaraan_keluar").removeClass('is-invalid');
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