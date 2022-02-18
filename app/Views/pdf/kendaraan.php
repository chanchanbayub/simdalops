<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Pengeluaran Kendaraan</title>
</head>
<style>
	body {
		font-family: Arial;
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
		font-size: 14px;
		text-transform: uppercase;
		font-family: Arial;
		line-height: 15px;
		letter-spacing: 2px;
	}

	#p2 {
		font-size: 14px;
		text-transform: uppercase;
		line-height: 15px;
		letter-spacing: 2px;
	}

	#p3 {
		font-size: 11px;
		line-height: 15px;
	}

	#p4 {
		font-size: 11px;
		line-height: 15px;
		font-family: 'Arial';
	}

	#p5 {
		font-size: 11px;
		text-transform: capitalize;
		vertical-align: top;
		/* border: 1px solid black; */
		padding-right: 25px;
	}

	/* #divine {
		border: 300px solid black;
	} */

	#td {
		text-align: right;
	}

	.noSurat {
		width: 100%;
		margin: 0 auto;
	}

	#noSuratKend {
		margin: 0 auto;
		width: 100%;
		font-size: 12px;
		margin-top: -10px;
		font-family: Arial;
		/* border: 1px solid black; */
	}

	#date {
		padding-right: 50px;
	}

	#content {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial;
		width: 90%;
		/* margin-top: 20px; */
		padding-left: 60px;
		text-align: justify;
		padding-top: 10px;
		/* padding-bottom: 5px; */
	}

	#content-table {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial;
		width: 90%;
		padding-left: 60px;
		padding-right: 60px;
		text-align: justify;
	}


	#content-table td {
		padding: 10px 0 3px 0;
		font-size: 12px;
	}

	#content-footer {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial;
		width: 90%;
		padding-left: 60px;
		text-align: justify;
		line-height: 20px;
		/* padding-top: px; */
	}

	#divine {
		border: 100px solid black;
	}

	#ttd {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial;
		width: 80%;
		text-align: right;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	#footer {
		margin: 0 auto;
		width: 100%;
		font-family: Arial;
		font-size: 12px;
	}
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
					<p id="p4">Website : www.dishub.jakarta.go.id &nbsp; E-mail : admsuratdishubdki@gmail.com </p>
					<p id="p4">J A K A R T A</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" id="p5">
					Kode Pos : 10150
				</td>
			</tr>
		</table>
	</header>
	<hr id="divine">
	<div class="noSurat">
		<table id="noSuratKend">
			<tr>
				<td style=" width:13%"> No</td>
				<td style="width: 2%;">:</td>
				<td>&nbsp; <?= $pengeluaran["nomor_surat"] ?> &nbsp;/ 073.554</td>
				<td colspan="11" align="right">
					<p id="date"> &nbsp; <?= date('d F Y') ?> </p>
				</td>
				<td colspan="3">&nbsp;</td>

			</tr>
			<tr>
				<td style="width:13%"> Sifat</td>
				<td style="width: 2%;">:</td>
				<td></td>
				<td colspan="14"></td>
			</tr>
			<tr>
				<td style="width:13%"> Lampiran</td>
				<td style="width: 2%;">:</td>
				<td colspan="15"></td>
			</tr>
			<tr>
				<td style="width:13%"> Hal</td>
				<td style="width: 2%;">:</td>
				<td style="width: 35%;">Pengeluaran Kendaraan</td>
				<td style="width: 5%">&nbsp;</td>
				<td colspan="13" style="padding-left: 60px;">Kepada</td>
			</tr>
			<tr>
				<td style="width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;" style="text-align: right;">Yth.</td>
				<td colspan="13" style="padding-left: 60px;">Kepala Terminal Mobil Barang </td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style="padding-left: 60px;"><?= $pengeluaran["nama_terminal"] ?> Dinas Perhubungan </td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style=" padding-left: 60px;">Provinsi DKI Jakarta</td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style=" padding-left: 60px;">di</td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style="padding-left: 75px;">J a k a r t a</td>
			</tr>
		</table>
		<table id="content">
			<tr>
				<td>
					<p> Bertalian dengan pelanggaran yang dilakukan oleh kendaraan :</p>
				</td>
			</tr>
		</table>
		<table id="content-table">
			<tr>
				<td style="width:40%">
					1. Nomor Kendaraan
				</td>
				<td style="width: 5%;">
					:
				</td>
				<td> <?= $pengeluaran["nopol"] ?> &nbsp; &nbsp; / &nbsp; &nbsp; <?= $pengeluaran["type_kendaraan"] ?></td>
			</tr>
			<tr>
				<td>
					2. Nomor Rangka
				</td>
				<td>
					:
				</td>
				<td><?= $pengeluaran["nomor_rangka"] ?></td>
			</tr>
			<tr>
				<td>
					3. Nama Pemilik / Perusahaan
				</td>
				<td>
					:
				</td>
				<td><?= $pengeluaran["nama_pemilik"] ?></td>
			</tr>
			<tr>
				<td>
					4. Alamat
				</td>
				<td>
					:
				</td>
				<td><?= $pengeluaran["alamat_pemilik"] ?></td>
			</tr>
			<tr>
				<td>
					5. Pelanggaran
				</td>
				<td>
					:
				</td>
				<td><?= $pengeluaran["jenis_pelanggaran"] ?></td>
			</tr>
			<tr>
				<td>
					6. Lokasi
				</td>
				<td>
					:
				</td>
				<td> <?= $pengeluaran["lokasi_pelanggaran"] ?> </td>
			</tr>
			<tr>
				<td>
					7. Hari / Tanggal
				</td>
				<td>
					:
				</td>
				<td> <?= date('d F Y', strtotime($pengeluaran["tanggal_pelanggaran"]))  ?> </td>
			</tr>
		</table>
		<table id="content-footer">
			<tr>
				<td>
					<p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; Bersama ini diberitahukan bahwa kendaraan tersebut diatas dapat dikeluarkan dari Terminal Mobil Barang Pool Rawa Buaya Dinas Perhubungan Provinsi DKI Jakarta, sehubungan yang bersangkutan telah :
						<br>
						a. Membuat surat pernyataan;
						<br>
						b. Mengikuti Sidang Pengadilan;
						<br>
						c. Melengkapi surat-surat kendaraan dimaksud;
						<br>
						d. Membayar retribusi sesuai ketentuan berlaku.
						<br>
						&nbsp; &nbsp; &nbsp; &nbsp;Demikian untuk dimaklumi dan pelaksaan lebih lanjut.
					</p>
				</td>
			</tr>
		</table>
		<table id="ttd">
			<tr>
				<td style="width: 50%;"></td>
				<td></td>
				<td align="center" style="width:75%">a.n. Kepala Dinas Perhubungan Provinsi DKI Jakarta</td>
			</tr>
			<tr>
				<td style="width: 50%;"></td>
				<td></td>
				<td align="center" style="width:75%">Kepala Bidang Pengendalian Operasional</td>
			</tr>
			<tr>
				<td style="width: 50%;"></td>
				<td></td>
				<td align="center" style="width:75%">Lalu Lintas Dan Angkutan Jalan</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center">
					<img class="ttd" src="<?= $profil["ttd"] ?>" width="150px" alt="signature-data">
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><?= $profil["namaLengkap"] ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center">NIP. <?= $profil["nip"] ?> </td>
			</tr>
		</table>
		<table id="footer">
			<tr>
				<td>Tembusan :</td>

			</tr>
			<tr>
				<td>
					1. Kepala Dinas Perhubungan Prov. DKI Jakarta.
				</td>
			</tr>
			<tr>
				<td>
					2. Sekretaris Dinas Perhubungan Provinsi Dki Jakarta
				</td>
			</tr>

		</table>
	</div>
</body>

</html>