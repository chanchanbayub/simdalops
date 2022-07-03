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
				<td>
					<img class="logo" src="assets/img/logo2.png" alt="logo" />
				</td>
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
				<td rowspan="1">
					<h4> &nbsp;&nbsp; "PRO JUSTITIA"</h4>
				</td>
				<td rowspan="3">
					<h4 style="text-align:center ;">BERITA ACARA PEMERIKSAAN CEPAT</h4>
					<h4 style="text-align:center ;">PELANGGARAN LALU LINTAS DAN ANGKUTAN JALAN</h4>
					<h4>No. BAP/........................... / ............ /JKT/...............</h4>
				</td>
				<td rowspan="2">
					<h4>A.00001</h4>
					<br>
					<h4>TERDAKWA</h4>
				</td>
			</tr>
		</table>
		<table class="content">
			<tr>
				<td>
					<p>Pada hari ini <b> <?= strftime('%A', strtotime($penindakan["tanggal_penindakan"])) ?> </b> tanggal <b> <?= date('d F Y', strtotime($penindakan["tanggal_penindakan"]))  ?></b> saya sebagaimana tersebut bertanda tangan di bawah ini selaku Penyidik Pegawai Negeri Sipil (PPNS) pada Dinas Perhubungan Provinsi DKI Jakarta telah memeriksa Perkara Pelanggaran Lalu Lintas Jalan sesuai UU No.8 Tahun 1981 tentang Hukum Acara Pidana Pasal 211 dan/atau UU No.22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan dan/atau UU No.23 Tahun 2014 tentang Pemerintahan Daerah dan/atau Peraturan Daerah Provinsi DKI Jakarta No.8 Tahun 2007 tentang Ketertiban Umum dan/atau Peraturan Daerah Provinsi DKI Jakarta No.5 Tahun 2014 tentang Transportasi.</p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<h3>1. PERKARA</h3>
				</td>
			</tr>
		</table>
		<table class="paragraf-table">
			<tr>
				<td align="justify">
					<p> Pelanggaran Lalu Lintas dan Angkutan Jalan berupa Pasal <b> <?= $penindakan["pasal_pelanggaran"]  ?> </b> <b> <?= $penindakan["keterangan"] ?> </b> hari .................................................................................... tanggal <b> <?= date('d F Y', strtotime($penindakan["tanggal_penindakan"])) ?> </b> jam <b><?= $penindakan["jam_penindakan"] ?> </b> WIB di Jalan <b> <?= $penindakan["lokasi_pelanggaran"] ?> </b>
					</p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<h3>2. KETERANGAN SAKSI/PETUGAS</h3>
				</td>
			</tr>
		</table>
		<table class="paragraf-table">
			<tr>
				<td>
					<p> Pelanggaran Lalu Lintas dan Angkutan Jalan berupa ............................................................................................................... hari .................................................................. tanggal <b> <?= date('d F Y', strtotime($penindakan["tanggal_penindakan"])) ?> </b> jam <b><?= $penindakan["jam_penindakan"] ?> </b> WIB di Jalan <b> <?= $penindakan["lokasi_pelanggaran"] ?> </b>
					</p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<h3>3. KETERANGAN TERDAKWA</h3>
				</td>
			</tr>
		</table>
		<table class="paragraf-table">
			<tr>
				<td align="justify">
					<p>Nama <b> <?= $penindakan["nama_pelanggar"] ?> </b> pekerjaan .......................................................................... tempat tanggal lahir ..................................................................................... jenis kelamin ............................................... tempat tinggal <b> <?= $penindakan["alamat_pelanggar"] ?> </b> Menerangkan bahwa pada tanggal tersebut telah melakukan pelanggaran Lalu Lintas dan Angkutan Jalan dengan menggunakan kendaraan bermotor Angkutan Umum / Mobil Barang : <b> <?= $penindakan["nama_kendaraan"] ?> </b> dengan No. Kendaraan <b> <?= $penindakan["nopol"] ?> </b> Sesuai dengan UU No.8 Tahun 1981 tentang Hukum Acara Pidana Pasal 213, Terdakwa dapat menunjuk seorang dengan surat untuk mewakilinya di sidang.
					</p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<h3>4. BARANG BUKTI</h3>
				</td>
			</tr>
		</table>
		<table class="paragraf-table">
			<tr>
				<td align="justify">
					<p>Berdasarkan UU No.8 Tahun 1981 tentang Hukum Acara Pidana dan UU No.22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan. Barang Bukti yang disita dari terdakwa berupa : </p>
					<p> a. Kartu Uji Berkala No:.............................................berlakus.d.tanggal..........................................</p>
					<p> b. Kartu Pengawasan No:.............................................berlakus.d.tanggal.......................................... </p>
					<p> c. Lain-lain......................................................</p>
					<p> d. Kendaraan dilakukan penundaan operasi sementara di <b><?= $penindakan["nama_terminal"] ?></b></p>
				</td>
			</tr>
		</table>
		<table class="content-table">
			<tr>
				<td>
					<h3>5. PETUNJUK</h3>
				</td>
			</tr>
		</table>
		<table class="paragraf-table">
			<tr>
				<td align="justify">
					<p>Berdasarkan Keterangan Saksi dan Keterangan Terdakwa serta melihat Barang Bukti yang disita memberi petunjuk bahwa Terdakwa telah melakukan pelanggaran Lalu Lintas dan Angkutan Jalan sesuai Pasal di atas selanjutnya Terdakwa diperintahkan menghadap di Pengadilan Negeri <b> <?= $penindakan["lokasi_sidang"] ?> </b> Pada hari <b> <?= strftime('%A', strtotime($penindakan["tanggal_sidang"])) ?> </b> tanggal <b> <?= date('d F Y', strtotime($penindakan["tanggal_sidang"])) ?> </b> jam................. WIB di Jalan ....................................................................................... Demikian catatan pemeriksaan perkara pelanggaran Lalu Lintas Jalan ini dibuat sebenarnya dengan mengingat sumpah jabatan, ditutup dan ditandatangani pada hari dan tanggal seperti tersebut pada permulaan, Catatan perkara pelanggaran tertentu sesuai UU No.8 Tahun 1981 tentang Hukum Acara Pidana Pasal 211 s.d. 216 tentang pemeriksaan perkara pelanggaran tertentu terhadap peraturan perundang-undangan lalu lintas jalan.</p>
				</td>
			</tr>
		</table>
		<table class="catatan">
			<tr>
				<td>
					<p>Catatan :</p>
				</td>
			</tr>
		</table>
		<table class="catatan">
			<tr>
				<td align="justify">
					<h5> <i> Bukti catatan pemeriksaan perkara Pelanggaran Lalu Lintas Jalan (Pemeriksaan Cepat) ini berlaku sebagai tanda penerimaan atau pengganti surat-surat atau benda yang disita, sampai disidangkan perkaranya di pengadilan sesuai dengan tanggal yang tercantum di atas. </i></h5>
				</td>
			</tr>
		</table>
		<br>
		<table class="table-footer" align="center" border="1px">
			<tr>
				<td align="center">SAKSI</td>
				<td align="center">TERDAKWA</td>
				<td align="center">PENYIDIK PEGAWAI NEGERI SIPIL</td>
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
				<td>(..................................................)</td>
				<td align="center">(<?= $penindakan["nama_pelanggar"] ?>)</td>
				<td></td>
			</tr>
			<tr>
				<td>NIP/NRK :.....................................</td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</body>

</html>