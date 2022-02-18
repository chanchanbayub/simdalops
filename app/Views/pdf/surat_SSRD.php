<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak SSRD</title>
</head>
<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	/* body {
		font-family: Arial;
	} */

	header {
		width: 100%;
		margin: 0 auto;
		position: relative;
		top: 0;
		left: 0;
	}

	#kopSurat {
		width: 100%;
		margin: 0 auto;
		border-collapse: collapse;
		/* border: 1px solid black */
	}

	.logo {
		position: absolute;
		top: 0;
		width: 75px;
	}

	#p1 {
		font-size: 17px;
		text-transform: uppercase;
		font-family: Arial;
		line-height: 19px;
		letter-spacing: 2px;
	}

	#p2 {
		font-size: 19px;
		text-transform: uppercase;
		line-height: 23px;
		letter-spacing: 2px;
	}

	#p3 {
		font-size: 14px;
		line-height: 15px;
	}

	#p4 {
		font-size: 16px;
		line-height: 18px;
		font-family: 'Arial Narrow';
	}

	#p5 {
		letter-spacing: 4px;
		font-size: 16px;
		line-height: 18px;
		text-transform: uppercase;
		vertical-align: top;
		border: 1px solid black;
	}

	.noSurat {
		width: 100%;
		margin: 0 auto;
	}

	#noSuratSSRD {
		margin: 0 auto;
		width: 90%;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
		/* border: 1px solid black; */
	}

	#content {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
		width: 80%;
		margin-top: 30px;
		padding-left: 60px;
		text-align: justify;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	#content-table {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
		width: 80%;
		/* margin-top: 30px; */
		padding-left: 60px;
		padding-right: 60px;
		text-align: justify;

	}

	#content-table td {
		padding: 10px 0 10px 0;
	}

	#content-footer {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
		width: 80%;
		padding-left: 60px;
		text-align: justify;
		padding-top: 20px;

	}

	#ttd {
		margin: 0 auto;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
		width: 80%;
		text-align: right;
		padding-top: 20px;
		padding-bottom: 20px;
	}

	#footer {
		margin: 0 auto;
		width: 90%;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}

	.ttd {
		position: absolute;
		top: 10;
		left: 0;
		z-index: 99;
		/* border: 1px solid black; */
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
		</table>
	</header>
	<hr>

	<div class="noSurat">
		<table id="noSuratSSRD">
			<tr>
				<td style="width:13%"> Nomor</td>
				<td style="width: 2%;">:</td>
				<td>&nbsp; &nbsp;/ -089</td>
				<td colspan="10" align="right"><?= date('d F Y') ?></td>
				<td colspan="4" align="right"></td>
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
				<td colspan="15">2 (Dua) Lembar</td>
			</tr>
			<tr>
				<td style="width:13%"> Hal</td>
				<td style="width: 2%;">:</td>
				<td style="width: 35%;">Permohonan Penerbitan SSRD</td>
				<td style="width: 5%">&nbsp;</td>
				<td colspan="13" style="padding-left: 35px;">Kepada</td>
			</tr>
			<tr>
				<td style="width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;" style="text-align: right;">Yth.</td>
				<td colspan="13" style="padding-left: 35px;">Bendahara &nbsp; &nbsp; &nbsp; &nbsp; Penerimaan &nbsp; &nbsp; &nbsp; &nbsp; Dinas</td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style="font-size: 12px; padding-left: 35px;">Perhubungan Provinsi DKI Jakarta.</td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style=" padding-left: 35px;">di</td>
			</tr>
			<tr>
				<td style=" width:13%"></td>
				<td style="width: 2%;"></td>
				<td style="width: 35%;"></td>
				<td style="width: 7%;"></td>
				<td colspan="13" style="padding-left: 50px;">Jakarta</td>
			</tr>
		</table>
		<table id="content">
			<tr>
				<td>
					<p> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Sehubungan dengan akan diterbitkannya surat pengeluaran kendaraan yang dititipkan di terminal mobil barang, dengan ini dimohon Saudara dapat menerbitkan SSRD untuk pembayaran Retribusi Pemakaian Terminal Penumpang Mobil Bus dan Terminal Mobil Barang oleh Wajib Retribusi dengan Data Sebagai Berikut </p>
				</td>
			</tr>
		</table>
		<table id="content-table">
			<tr>
				<td style="width:40%">
					Nama Wajib Retribusi
				</td>
				<td style="width: 5%;">
					:
				</td>
				<td></td>
			</tr>
			<tr>
				<td>
					Alamat
				</td>
				<td>
					:
				</td>
				<td></td>
			</tr>
			<tr>
				<td>
					Tanggal Pelanggaran
				</td>
				<td>
					:
				</td>
				<td><?= date('d / m / Y', strtotime($suratPengeluaran["tanggal_pelanggaran"]))  ?></td>
			</tr>
			<tr>
				<td>
					Jenis Kendaraan
				</td>
				<td>
					:
				</td>
				<td> <?= $suratPengeluaran["type_kendaraan"] ?> </td>
			</tr>
			<tr>
				<td>
					Nomor Kendaraan
				</td>
				<td>
					:
				</td>
				<td><?= $suratPengeluaran["nopol"] ?></td>
			</tr>
			<tr>
				<td>
					Tempat penitipan Kendaraan
				</td>
				<td>
					:
				</td>
				<td> <?= $suratPengeluaran["nama_terminal"] ?></td>
			</tr>
		</table>
		<table id="content-footer">
			<tr>
				<td>
					<p> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih. </p>
				</td>
			</tr>
		</table>
		<table id="ttd">
			<tr>
				<td style="width: 50%;"></td>
				<td></td>
				<td align="center" style="width:75%">Penanggung Jawab</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center">
					<img class="ttd" src="<?= $profil["ttd"] ?>" width="100px" alt="signature-data">
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
				<td align="center">NIP. <?= $profil["nip"] ?></td>
			</tr>
		</table>
		<table id="footer">
			<tr>
				<td>Tembusan</td>
				<td>:</td>
			</tr>
			<tr>
				<td>
					1. Sekretaris Dinas Perhubungan Provinsi Dki Jakarta
				</td>
			</tr>

		</table>
	</div>
</body>

</html>