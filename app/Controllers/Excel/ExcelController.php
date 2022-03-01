<?php

namespace App\Controllers\Excel;

use App\Controllers\BaseController;
use App\Models\Operator\LaporanPenindakanModel;
use App\Models\Operator\SuratPengeluaranModel;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends BaseController
{
    protected $suratPengeluranModel;
    protected $date;
    protected $laporanPenindakanModel;


    public function __construct()
    {
        $this->suratPengeluranModel = new SuratPengeluaranModel();
        $this->date = new DateTime();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
    }

    public function index()
    {

        $now = $this->date->format('Y-m-d');

        $suratPengeluraan = $this->suratPengeluranModel->pengeluaranHarian($now);
        // dd($suratPengeluraan);

        $spreadSheet = new Spreadsheet();

        $spreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'UKPD')
            ->setCellValue('B1', 'No Bap')
            ->setCellValue('C1', 'Type Kendaraan')
            ->setCellValue('D1', 'No Kendaraan')
            ->setCellValue('E1', 'Jenis Pelanggaran')
            ->setCellValue('F1', 'Lokasi Pelanggaran')
            ->setCellValue('G1', 'Tanggal Pelanggaran')
            ->setCellValue('H1', 'Pool Penyimpanan')
            ->setCellValue('J1', 'Tahun')
            ->setCellValue('K1', 'Nomor Rangka')
            ->setCellValue('L1', 'Nama Pemilik')
            ->setCellValue('M1', 'Alamat Pemilik')
            ->setCellValue('N1', 'Catatan')
            ->setCellValue('O1', 'Tanggal Pengeluaran');
        $column = 2;

        foreach ($suratPengeluraan as $pengeluaran) {
            $spreadSheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $pengeluaran["ukpd"])
                ->setCellValue('B' . $column, $pengeluaran["noBap"])
                ->setCellValue('C' . $column, $pengeluaran["type_kendaraan"])
                ->setCellValue('D' . $column, $pengeluaran["nopol"])
                ->setCellValue('E' . $column, $pengeluaran["keterangan"])
                ->setCellValue('F' . $column, $pengeluaran["lokasi_pelanggaran"])
                ->setCellValue('G' . $column, $pengeluaran["tanggal_pelanggaran"])
                ->setCellValue('H' . $column, $pengeluaran["nama_terminal"])
                ->setCellValue('J' . $column, $pengeluaran["tahun"])
                ->setCellValue('K' . $column, $pengeluaran["noRangka"])
                ->setCellValue('L' . $column, $pengeluaran["namaPemilik"])
                ->setCellValue('M' . $column, $pengeluaran["alamatPemilik"])
                ->setCellValue('N' . $column, $pengeluaran["catatan_lain"])
                ->setCellValue('O' . $column, $pengeluaran["tgl_pengeluaran"]);

            $column++;
        }
        $writter = new Xlsx($spreadSheet);
        $file = 'TEST';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file . '.xlsx');
        header('Cache-Control: max-age=0');

        $writter->save('php://output');
    }

    public function arsip_laporan()
    {
        $now = $this->date->format('Y-m-d');

        $laporan_harian = $this->laporanModel->exportExcel();

        $spreadSheet = new Spreadsheet();

        $spreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'UKPD')
            ->setCellValue('B1', 'Unit / Regu')
            ->setCellValue('C1', 'No BAP')
            ->setCellValue('D1', 'Jenis Penindakan')
            ->setCellValue('E1', 'Klasifikasi Kendaraan')
            ->setCellValue('F1', 'Type Kendaraan')
            ->setCellValue('G1', 'Tanggal Penindakan')
            ->setCellValue('H1', 'Tanggal Sidang')
            ->setCellValue('I1', 'Lokasi Sidang')
            ->setCellValue('J1', 'Jam Penindakan')
            ->setCellValue('K1', 'Jenis Pelanggaran')
            ->setCellValue('L1', 'Pasal Pelanggaran')
            ->setCellValue('M1', 'Lokasi Pelanggaran')
            ->setCellValue('N1', 'Barang Bukti')
            ->setCellValue('O1', 'Pool Penyimpanan')
            ->setCellValue('P1', 'Nama Pelanggar')
            ->setCellValue('Q1', 'Alamat Pelanggar')
            ->setCellValue('R1', 'Warna TNKB')
            ->setCellValue('S1', 'Tahun Perakitan')
            ->setCellValue('T1', 'Nomor Rangka')
            ->setCellValue('U1', 'Nama Pemilik')
            ->setCellValue('P1', 'Alamat Pemilik');
        $column = 2;

        foreach ($laporan_harian as $laporan) {
            $spreadSheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $laporan["ukpd"])
                ->setCellValue('B' . $column, $laporan["unit_penindak"])
                ->setCellValue('C' . $column, $laporan["noBap"])
                ->setCellValue('D' . $column, $laporan["nama_penindakan"])
                ->setCellValue('E' . $column, $laporan["nama_kendaraan"])
                ->setCellValue('F' . $column, $laporan["type_kendaraan"])
                ->setCellValue('G' . $column, $laporan["tanggal_penindakan"])
                ->setCellValue('H' . $column, $laporan["tanggal_sidang"])
                ->setCellValue('I' . $column, $laporan["lokasi_sidang"])
                ->setCellValue('J' . $column, $laporan["jam_penindakan"])
                ->setCellValue('K' . $column, $laporan["keterangan"])
                ->setCellValue('L' . $column, "Pasal " . $laporan["pasal_pelanggaran"])
                ->setCellValue('M' . $column, $laporan["lokasi_pelanggaran"])
                ->setCellValue('N' . $column, $laporan["barang_bukti"])
                ->setCellValue('O' . $column, $laporan["nama_terminal"])
                ->setCellValue('P' . $column, $laporan["nama_pelanggar"])
                ->setCellValue('Q' . $column, $laporan["alamat_pelanggar"])
                ->setCellValue('R' . $column, $laporan["warna_tnkb"])
                ->setCellValue('S' . $column, $laporan["tahun_perakitan"])
                ->setCellValue('T' . $column, $laporan["nomor_rangka"])
                ->setCellValue('U' . $column, $laporan["nama_pemilik"])
                ->setCellValue('P' . $column, $laporan["alamat_pemilik"]);

            $column++;
        }
        $writter = new Xlsx($spreadSheet);
        $file = 'arsip_laporan';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file . '.xlsx');
        header('Cache-Control: max-age=0');

        $writter->save('php://output');
    }

    public function exportLaporanPenindakan($keyword)
    {
        $laporan_penindakan = $this->laporanPenindakanModel->search($keyword);

        $data = $laporan_penindakan["laporan_penindakan"]->get()->getResultArray();


        $spreadSheet = new Spreadsheet();

        $spreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'DATA KENDARAAN ANGKUTAN UMUM DAN BARANG HASIL OPERASI PENERTIBAN BIDANG DALOPS')
            ->setCellValue('A2', 'DINAS PERHUBUNGAN PROVINSI DKI JAKARTA')
            ->setCellValue('A3', 'TANGGAL');
        $spreadSheet->getActiveSheet()->mergeCells('A1:X1');
        $spreadSheet->getActiveSheet()->mergeCells('A2:X2');
        $spreadSheet->getActiveSheet()->mergeCells('A3:X3');

        $spreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'NO')
            ->setCellValue('B4', 'UKPD')
            ->setCellValue('C4', 'BAP')
            ->setCellValue('D4', 'NAMA PEMILIK')
            ->setCellValue('E4', 'TYPE KENDARAAN')
            ->setCellValue('F4', 'TAHUN PERAKITAN')
            ->setCellValue('G4', 'KLASIFIKASI KENDARAAN')
            ->setCellValue('H4', 'WARNA TNKB')
            ->setCellValue('I4', 'NOMOR KENDARAAN')
            ->setCellValue('J4', 'JENIS PELANGGARAN')
            ->setCellValue('K4', 'PASAL PELANGGARAN')
            ->setCellValue('L4', 'TKP')
            ->setCellValue('M4', 'JENIS TINDAKAN')
            ->setCellValue('N4', 'BARANG BUKTI')
            ->setCellValue('O4', 'TANGGAL PENINDAKAN')
            ->setCellValue('P4', 'JAM PENINDAKAN')
            ->setCellValue('Q4', 'TANGGAL SIDANG')
            ->setCellValue('R4', 'LOKASI SIDANG')
            ->setCellValue('S4', 'POOL PENYIMPANAN')
            ->setCellValue('T4', 'NAMA PELANGGAR')
            ->setCellValue('U4', 'ALAMAT PELANGGAR')
            ->setCellValue('V4', 'ALAMAT PEMILIK')
            ->setCellValue('W4', 'UNIT PENINDAK')
            ->setCellValue('X4', 'NAMA PETUGAS');
        $column = 5;
        $no = 1;
        foreach ($data as $laporan) {
            $spreadSheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $laporan["ukpd"])
                ->setCellValue('C' . $column, $laporan["noBap"])
                ->setCellValue('D' . $column, $laporan["nama_pemilik"])
                ->setCellValue('E' . $column, $laporan["type_kendaraan"])
                ->setCellValue('F' . $column, $laporan["tahun_perakitan"])
                ->setCellValue('G' . $column, $laporan["nama_kendaraan"])
                ->setCellValue('H' . $column, $laporan["warna_tnkb"])
                ->setCellValue('I' . $column, $laporan["nopol"])
                ->setCellValue('J' . $column, $laporan["keterangan"])
                ->setCellValue('K' . $column, "Pasal " . $laporan["pasal_pelanggaran"])
                ->setCellValue('L' . $column, $laporan["lokasi_pelanggaran"])
                ->setCellValue('M' . $column, $laporan["nama_penindakan"])
                ->setCellValue('N' . $column, $laporan["barang_bukti"])
                ->setCellValue('O' . $column, $laporan["tanggal_penindakan"])
                ->setCellValue('P' . $column, $laporan["jam_penindakan"])
                ->setCellValue('Q' . $column, $laporan["tanggal_sidang"])
                ->setCellValue('R' . $column, $laporan["lokasi_sidang"])
                ->setCellValue('S' . $column, $laporan["nama_terminal"])
                ->setCellValue('T' . $column, $laporan["nama_pelanggar"])
                ->setCellValue('U' . $column, $laporan["alamat_pelanggar"])
                ->setCellValue('V' . $column, $laporan["alamat_pemilik"])
                ->setCellValue('W' . $column, $laporan["unit_penindak"])
                ->setCellValue('X' . $column, $laporan["nama_petugas"]);
            $column++;
        }
        $writter = new Xlsx($spreadSheet);
        $file = 'Penindakan -' . $keyword;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file . '.xlsx');
        header('Cache-Control: max-age=0');

        $writter->save('php://output');
    }

    public function exportDataSidang($ukpd_id, $tanggal_sidang, $lokasi_sidang_id)
    {
        $now = $this->date->format('Y-m-d');

        // dd($ukpd_id);
        // $ukpd_id = $this->request->getVar('ukpd_id');

        // $tanggal_sidang = $this->request->getVar('tanggal_sidang');

        // $lokasi_sidang_id = $this->request->getVar('lokasi_sidang_id');

        // dd($ukpd_id, $tanggal_sidang, $lokasi_sidang_id);

        $laporanPenindakan = $this->laporanPenindakanModel->getDataSidang($ukpd_id, $tanggal_sidang, $lokasi_sidang_id);
        // dd($laporanPenindakan);

        $spreadSheet = new Spreadsheet();

        $spreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'UKPD')
            ->setCellValue('B1', 'NO BA')
            ->setCellValue('C1', 'No BAP')
            ->setCellValue('D1', 'TANGGAL BAP')
            ->setCellValue('E1', 'TYPE KENDARAAN')
            ->setCellValue('F1', 'NAMA PELANGGAR')
            ->setCellValue('G1', 'ALAMAT')
            ->setCellValue('H1', 'BARANG BUKTI')
            ->setCellValue('I1', 'PASAL YANG DILANGGAR')
            ->setCellValue('J1', 'KETERANGAN');
        $column = 2;

        foreach ($laporanPenindakan as $laporan) {
            $spreadSheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $laporan["ukpd"])
                ->setCellValue('B' . $column, '')
                ->setCellValue('C' . $column, $laporan["noBap"])
                ->setCellValue('D' . $column, $laporan["tanggal_penindakan"])
                ->setCellValue('E' . $column, $laporan["type_kendaraan"])
                ->setCellValue('F' . $column, $laporan["nama_pelanggar"])
                ->setCellValue('G' . $column, $laporan["alamat_pelanggar"])
                ->setCellValue('H' . $column, $laporan["barang_bukti"])
                ->setCellValue('I' . $column, $laporan["pasal_pelanggaran"])
                ->setCellValue('J' . $column, $laporan["nopol"]);

            $column++;
        }
        $writter = new Xlsx($spreadSheet);
        $file = 'laporan_harian';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file . '.xlsx');
        header('Cache-Control: max-age=0');

        $writter->save('php://output');

        // return view('test');
    }
}
