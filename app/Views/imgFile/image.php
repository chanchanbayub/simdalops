<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Gambar</title>
</head>
<style>
    h3 {
        padding-bottom: 10px;
    }
</style>

<body>

    <h3>Kwitansi Sidang</h3>
    <img src="admTilang/<?= $pengeluaran["scan_kwitansi_sidang"] ?>" width="80%" alt="">

    <br>
    <?php if ($pengeluaran["scan_pengantar_sidang"] != NULL) : ?>
        <h3>Pengantar Sidang</h3>
        <img src="admTilang/<?= $pengeluaran["scan_pengantar_sidang"] ?>" width="80%" alt="">
    <?php else : ?>
        <h3>Pengantar Sidang</h3>
    <?php endif; ?>
    <br>
    <?php if ($pengeluaran["scan_stuk"] != NULL) : ?>
        <h3>STUK</h3>
        <img src="admTilang/<?= $pengeluaran["scan_stuk"] ?>" width="80%" alt="">
    <?php else : ?>
        <h3>STUK</h3>
    <?php endif; ?>
    <br>
    <?php if ($pengeluaran["scan_kartu_pengawasan"] != NULL) : ?>
        <h3>Kartu Pengawasan</h3>
        <img src="admTilang/<?= $pengeluaran["scan_kartu_pengawasan"] ?>" width="80%" alt="">
    <?php else : ?>
        <h3>Kartu Pengawasan</h3>
    <?php endif; ?>

</html>