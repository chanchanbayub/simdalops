<?php

namespace App\Controllers\Kasie;

use App\Controllers\BaseController;
use App\Models\Kasie\SuratPengeluaranModel;
use App\Models\Kasie\ProfileModel;
use DateTime;

class SuratPengeluaran extends BaseController
{
    protected $profilModel;
    protected $suratPengeluaranModel;
    protected $date;

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
            'title' => 'Verifikasi Berkas Masuk',
            'suratPengeluaran' => $suratPengeluaran["suratPengeluaran"]->paginate('10', 'surat_pengeluaran'),
            'pager' => $suratPengeluaran["suratPengeluaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('kasie/berkas_masuk', $data);
    }

    public function detail_surat($id)
    {
        $pengeluaran = $this->suratPengeluaranModel->getRowResult($id);

        $profil = $this->profilModel->getProfileName("Verifikator");

        $data = [
            'title' => 'Verifikasi Berkas Pengeluaran',
            'pengeluaran' => $pengeluaran,
            'profil' => $profil
        ];
        return view('kasie/detail_data', $data);
    }

    public function update_surat()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getPost('id');
            $status_surat_id = $this->request->getPost('status_surat_id');
            $catatan_lain = $this->request->getPost('catatan_lain');

            $this->suratPengeluaranModel->update($id, [
                'id' => $id,
                'status_surat_id' => $status_surat_id,
                'catatan_lain' => ucwords($catatan_lain)
            ]);

            $messeage = [
                'success' => 'Data Berhasil di Perbaharui!',
                'icon' => 'success'
            ];

            return json_encode($messeage);
        }
    }
}
