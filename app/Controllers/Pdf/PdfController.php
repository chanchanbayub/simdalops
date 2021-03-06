<?php

namespace App\Controllers\Pdf;

use App\Controllers\BaseController;
use App\Controllers\Petugas\LaporanPenindakan;
use App\Models\Derek\PenderekanModel;
use App\Models\Kabid\ProfileModel;
use App\Models\Operator\SuratPengeluaranModel;
use App\Models\Petugas\LaporanPenindakanModel;
use Mpdf\Mpdf;

class PdfController extends BaseController
{
    protected $pdf;
    protected $suratPengeluaran;
    protected $profileModel;
    protected $laporanPenindakanModel;
    protected $penderekanModel;

    public function __construct()
    {

        $this->suratPengeluaran = new SuratPengeluaranModel();
        $this->profileModel = new ProfileModel();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->penderekanModel = new PenderekanModel();
    }

    public function index($id)
    {

        $profil = $this->profileModel->getProfileName('Verifikator');

        $suratPengeluaran = $this->suratPengeluaran->getRowResult($id);
        // dd($suratPengeluaran);

        $data = [
            'profil' => $profil,
            'suratPengeluaran' => $suratPengeluaran
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330]]);
        $html = view('/pdf/surat_SSRD', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        // return redirect()->to($mpdf->output('Surat Permohonan Penerbitan SSRD.pdf', 'I'));
        $mpdf->output('Surat Permohonan Penerbitan SSRD.pdf', 'I');
    }

    public function pengeluaran($id)
    {

        $profil = $this->profileModel->getProfileName("Kepala Bidang");
        // dd($profil);

        $suratPengeluaran = $this->suratPengeluaran->getRowResult($id);

        $data = [
            'profil' => $profil,
            'pengeluaran' => $suratPengeluaran
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330]]);
        $html = view('/pdf/kendaraan', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->output('Surat Pengeluran Kendaraan.pdf', 'I');
    }

    public function viewImage($id)
    {
        $suratPengeluaran = $this->suratPengeluaran->getRowResult($id);

        $data = [
            'pengeluaran' => $suratPengeluaran
        ];

        $mpdf = new \Mpdf\Mpdf();
        $html = view('/imgFile/image', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->output('Image.pdf', 'I');
    }

    public function bap($id)
    {
        $dataPenindakan = $this->laporanPenindakanModel->getDataPenindakan($id);
        $hari_indonesia = array(
            'Monday'  => 'Senin',
            'Tuesday'  => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        );

        $data = [
            'penindakan' => $dataPenindakan,
            'hari_indonesia' => $hari_indonesia
        ];

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330]]);
        $html = view('/pdf/bap', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->output('bap.pdf', 'I');
    }

    public function bap_derek($id)
    {
        $penderekan = $this->penderekanModel->idPenderekan($id);
        $hari_indonesia = array(
            'Monday'  => 'Senin',
            'Tuesday'  => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        );

        $data = [
            'penderekan' => $penderekan,
            'hari_indonesia' => $hari_indonesia
        ];

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330]]);
        $html = view('/pdf/bap_derek', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->output('bap.pdf', 'I');
    }
}
