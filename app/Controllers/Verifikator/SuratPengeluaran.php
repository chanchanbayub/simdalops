<?php

namespace App\Controllers\Verifikator;

use App\Controllers\BaseController;
use App\Models\Verifikator\ProfileModel;
use App\Models\Verifikator\SuratPengeluaranModel;
use DateTime;

class SuratPengeluaran extends BaseController
{
    protected $suratPengeluaranModel;
    protected $date;
    protected $profilModel;

    public function __construct()
    {
        $this->suratPengeluaranModel = new SuratPengeluaranModel();
        $this->date = new DateTime();
        $this->profilModel = new ProfileModel();
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
            'title' => 'Surat Pengeluaran Kendaraan',
            'suratPengeluaran' => $suratPengeluaran["suratPengeluaran"]->paginate(10, 'surat_pengeluaran'),
            'pager' => $suratPengeluaran["suratPengeluaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('verifikator/surat_masuk', $data);
    }

    public function arsipSurat()
    {
        $keyword = $this->request->getVar('keyword');

        $currentPage = $this->request->getVar('page_surat_pengeluaran') ? $this->request->getVar('page_surat_pengeluaran') : 1;

        if ($keyword) {
            $suratPengeluaran = $this->suratPengeluaranModel->search($keyword);
        } else {
            $suratPengeluaran = $this->suratPengeluaranModel->arsipSuratPengeluaran();
        }
        // dd($suratPengeluaran);

        $data = [
            'title' => 'Arsip Surat Pengeluaran',
            'suratPengeluaran' => $suratPengeluaran["suratPengeluaran"]->paginate(5, 'surat_pengeluaran'),
            'pager' => $suratPengeluaran["suratPengeluaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('verifikator/arsipPengeluaran', $data);
    }

    public function detail_surat($id)
    {
        $pengeluaran = $this->suratPengeluaranModel->getRowResult($id);

        $profil = $this->profilModel->where(["users_id" => session('id')])->first();

        $data = [
            'title' => 'Verifikasi Berkas Pengeluaran',
            'pengeluaran' => $pengeluaran,
            'profil' => $profil
        ];
        return view('verifikator/detail_data', $data);
    }

    public function update_surat()
    {
        // dd($this->request->getVar())
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $status_id = $this->request->getVar('status_id');
            $rekomendasi = $this->request->getVar('rekomendasi_approv');

            $this->suratPengeluaranModel->update($id, [
                'id' => $id,
                'status_id' => $status_id,
                'rekomendasi_approv' => $rekomendasi,
            ]);

            $messeage = [
                'success' => 'Status Surat Berhasil di Verifikasi'
            ];

            return json_encode($messeage);
        }
    }
}
