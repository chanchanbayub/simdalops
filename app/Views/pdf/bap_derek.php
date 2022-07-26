<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BERITA ACARA PENINDAKAN CEPAT</title>
</head>
<style>
	* {
		overflow: auto;
	}

	header {
		width: 100%;
		margin: 0 auto;
		/* border: 1px solid black; */
	}

	#kopSurat {
		width: 100%;
		margin: 0 auto;
		border-collapse: collapse;
		margin-bottom: -15px;
		position: relative;
		top: 0;
		left: 0;
		z-index: 0;
	}

	.logo {
		width: 75px;
	}

	#p1 {
		font-size: 18px;
		text-transform: uppercase;
		font-family: Arial;
		line-height: 15px;
		letter-spacing: 0px;
		font-style: normal;
	}

	#p2 {
		font-size: 24px;
		text-transform: uppercase;
		line-height: 15px;
		letter-spacing: 1px;
		font-weight: 900;
	}

	#p3 {
		font-size: 14px;
		letter-spacing: 1px;
		line-height: 15px;
		font-family: Arial, Helvetica, sans-serif;
	}

	#p4 {
		font-size: 14px;
		line-height: 15px;
		letter-spacing: 0px;
		font-style: normal;
		font-family: Arial, Helvetica, sans-serif;
	}

	#p5 {
		font-size: 12px;
		text-transform: capitalize;
		vertical-align: top;
		/* border: 1px solid black; */
		padding-right: 40px;
		padding-bottom: 5px;
	}

	/* #divine {
		border: 300px solid black;
	} */
	hr {
		height: 2px;
		color: black;

		/* border: 10px solid black; */
	}

	#noSuratKend {
		margin: 0 auto;
		width: 100%;
		font-size: 14px;
		text-align: center;
		/* margin-top: -10px; */
		font-family: Arial;
	}

	#noSuratKend td {
		vertical-align: top;
	}

	.content {
		margin: 0 auto;
		font-family: Arial, Helvetica, sans-serif;
		width: 100%;
		text-align: justify;
		/* padding-top: 3px; */
		/* border: 1px solid black; */
	}

	.content p {
		font-size: 12px;
	}

	.content-table {
		margin: 0 auto;
		font-family: Arial, Helvetica, sans-serif;
		width: 100%;
		text-align: justify;
		/* padding-top: 3px; */
		/* border: 1px solid black; */
	}

	.paragraf-table {
		padding-left: 21px;
		font-family: Arial, Helvetica, sans-serif;
		/* border: 1px solid black; */
		width: 100%;
		font-size: 12px;
	}

	.catatan {
		padding-left: 21px;
		font-family: Arial, Helvetica, sans-serif;
		/* border: 1px solid black; */
		width: 100%;
		/* font-size: 12px; */
	}

	.table-footer {
		/* border: 1px solid black; */
		margin: 0 auto;
		font-family: Arial, Helvetica, sans-serif;
		width: 100%;
		/* text-align: center; */
		/* border: 1px solid black; */
	}

	.output {
		color: blue;
	}

	/* .table-footer td {
		text-align: center;
	} */
</style>

<body>

	<header>
		<table id="kopSurat">
			<tr>
				<td>
					<img class="logo" src="assets/img/logo.png" alt="logo" />
				</td>
				<td align="center">
					<p id="p1"> pemerintah daerah khusus ibu kota jakarta</p>
					<p id="p2"> dinas perhubungan</p>
					<p id="p3">Jalan Taman Jatibaru Nomor 1 Telepon 3501349 Faksimile 3455264</p>
					<p id="p4">Website : www.dishub.jakarta.go.id E-mail : admsuratdishubdki@gmail.com </p>
					<p id="p4">J A K A R T A</p>
				</td>
				<!-- <td>
					<img class="logo" src="assets/img/logo2.png" alt="logo" />
				</td> -->
			</tr>
			<tr>
				<td colspan="3" align="right" id="p5">
					Kode Pos : 10150
				</td>
			</tr>
		</table>
	</header>
	<hr>
	<div>
		<table id="noSuratKend">
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="center">
					<h2 style="text-align:center ;"> <u> BERITA ACARA </u></h2>
					<h3 style="text-align:center ;">PENDEREKAN PEMINDAHAN KENDARAAN</h3>
				</td>
				<td>
					<p> No.</p>
				</td>
				<td>
					<h3> <b style="color:red ;"><?= $penderekan["noBap"] ?></b></h3>
				</td>
			</tr>
		</table>
		<table class="content">
			<tr>
				<td>
					<p>Pada hari ini <b class="output"><?= $hari_indonesia[date('l', strtotime($penderekan["tanggal_penindakan"]))] ?></b>, tanggal <b class="output"> <?= date('d', strtotime($penderekan["tanggal_penindakan"]))  ?> </b> Bulan <b class="output"> <?= date('F', strtotime($penderekan["tanggal_penindakan"])) ?> </b> pukul <b class="output"> <?= $penderekan["jam_penindakan"] ?> </b> tahun <b class="output"> <?= date('Y', strtotime($penderekan["tanggal_penindakan"])) ?></b> <br>
						saya : <b class="output">Agus Ismail Kamil, S.sos. Msi</b>
						Pangkat <b class="output"></b> NIP <b class="output"> 197808172007011032 </b> Jabatan <b class="output"> STAF TEKNIS </b>
						Selaku Penyidik Pegawai Negeri Sipil (PPNS) dari kantor tersebut diatas, Bersama – sama dengan :
					</p>
					<p>1. <b class="output"> <?= $penderekan["nama_petugas"] ?></b></p>
					<p>2.</b></p>
					<p>Masing – masing dari kantor yang sama, berdasarkan :-------------------------------------------------------------------------------------------------Surat Tugas nomor <b class="output">583</b> / <b class="output">1811</b> / <b class="output"> 231 </b> tanggal <b class="output"> 31 Juli 2022</b> tentang
					<h2 class="output">PENDEREKAN</h2>
					</p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<p>Telah melakukan penderekan dan pemindahan kendaraan sesuai dengan Perda 5 Tahun 2014 tentang Transportasi di Jalan <b class="output"> <?= $penderekan["lokasi_pelanggaran"] ?></b> dengan keterangan sebagai berikut :</p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>Nama Pelanggar / Pengemudi </td>
				<td>:</td>
				<td> <b class="output"> <?= $penderekan["nama_pelanggar"] ?> </b></td>
			</tr>
			<tr>
				<td>NIK/SIM/PASPOR</td>
				<td>:</td>
				<td> <b class="output"> </b></td>
			</tr>
			<tr>
				<td>TNKB</td>
				<td>:</td>
				<td> <b class="output"> <?= $penderekan["nopol"] ?> </b></td>
			</tr>
			<tr>
				<td>Jenis Kendaraan</td>
				<td>:</td>
				<td> <b class="output"> <?= $penderekan["type_kendaraan"] ?> </b></td>
			</tr>
			<tr>
				<td>Warna Kendaraan</td>
				<td>:</td>
				<td> <b class="output"> <?= $penderekan["warna_kendaraan"] ?> </b></td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<p>Kendaraan tersebut dilakukan pemindahan dan penyimpanan pada : <b class="output"> <?= $penderekan["nama_terminal"] ?> </b></p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<p>----------Untuk pengeluaran kendaraan Saudara diwajibkan membayar retribusi sesuai Perda 1 tahun 2012 tentang Retribusi sesuai Perda 1 tahun 2015 tentang perubahan atas Perda 3 tahun 2012 tentang Retribusi Daerah dan menyelesaikan administrasi Pengeluaran Kendaraan selanjutnya pengambilan kendaraan dilakukan sebagaiman alamat tertera diatas.
						<br> ----------Demikian Berita Acara Penderekan pemindahan kendaraan ini dibuat dengan sebenar benarnya atas kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di <b class="output">Jakarta</b> pada tanggal <b class="output"> <?= date('d F Y', strtotime($penderekan["tanggal_penindakan"]))  ?>.</b>

					</p>
				</td>
			</tr>
		</table>


		<br>
		<table class="table-footer" align="center" border="1px">
			<tr>
				<td align="center">Petugas Lapangan</td>
				<td align="center">Saksi</td>
				<td align="center">Pengemudi</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td align="center">
					<p class="output">(<?= $penderekan["nama_petugas"] ?>)</p>
				</td>
				<td align="center">
					<p class="output">(<?= $penderekan["nama_petugas"] ?>)</p>
				</td>
				<td align="center">
					<p class="output">(<?= $penderekan["nama_pelanggar"] ?>)</p>
				</td>
			</tr>
		</table>
		<br>
		<p style="text-align: center ;">Mengetahui,</p>
		<p style="text-align: center ;">Penyidik Pegawai Negeri Sipil</p>
		<br><br><br><br>
		<p style="text-align: center;" class="output">(............................)</p>
	</div>
</body>

</html>