<?php

namespace App\Controllers\Kabid;

use App\Controllers\BaseController;
use App\Models\Kabid\ProfileModel;
use App\Models\Kabid\SuratPengeluaranModel;
use App\Models\Operator\BapModel;
use App\Models\Operator\LaporanPenindakanModel;
use DateTime;

class SuratPengeluaran extends BaseController
{
    protected $profilModel;
    protected $suratPengeluaranModel;
    protected $bapModel;
    protected $laporanPenindakanModel;
    protected $date;

    public function __construct()
    {
        $this->suratPengeluaranModel = new SuratPengeluaranModel();
        $this->date = new  DateTime();
        $this->profilModel = new ProfileModel();
        $this->bapModel = new BapModel();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
    }

    public function index()
    {
        $now = $this->date->format('Y-m-d');
        $currentPage = $this->request->getVar('page_surat_pengeluaran') ? $this->request->getVar('page_surat_pengeluaran') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $suratPengeluaran = $this->suratPengeluaranModel->search($keyword, $now);
        } else {
            $suratPengeluaran = $this->suratPengeluaranModel->suratMasuk($now);
        }
        // dd($suratPengeluaran);

        $data = [
            'title' => 'Verifikasi Berkas Masuk',
            'suratPengeluaran' => $suratPengeluaran["suratPengeluaran"]->paginate('10', 'surat_pengeluaran'),
            'pager' => $suratPengeluaran["suratPengeluaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('kabid/berkas_masuk', $data);
    }

    public function detail_surat($id)
    {
        $pengeluaran = $this->suratPengeluaranModel->getRowResult($id);

        $noBap = $this->bapModel->where(["noBap" => $pengeluaran["noBap"]])->first();

        $profil = $this->profilModel->getProfileName("Verifikator");

        $data = [
            'title' => 'Verifikasi Berkas Pengeluaran',
            'pengeluaran' => $pengeluaran,
            'profil' => $profil,
            'noBap' => $noBap
        ];
        return view('kabid/detail_data', $data);
    }

    public function update_surat()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getPost('id');
            $status_surat_id = $this->request->getPost('status_surat_id');
            // $catatan_lain = $this->request->getPost('catatan_lain');
            $bap_id = $this->request->getPost('bap_id');
            $status_id = $this->request->getPost('status_id');

            if (!empty($bap_id)) {
                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => $status_id
                ]);
            }

            $this->suratPengeluaranModel->update($id, [
                'id' => $id,
                'status_surat_id' => $status_surat_id,
                // 'catatan_lain' => ucwords($catatan_lain)
            ]);

            $messeage = [
                'success' => 'Data Berhasil di Perbaharui!',
                'icon' => 'success'
            ];

            return json_encode($messeage);
        }
    }
}
