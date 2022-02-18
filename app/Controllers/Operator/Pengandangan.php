<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Operator\PengandanganModel;

class Pengandangan extends BaseController
{
    protected $pengandanganModel;

    public function __construct()
    {
        $this->pengandanganModel = new PengandanganModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_pengandangan') ? $this->request->getVar('page_pengandangan') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pengandangan = $this->pengandanganModel->search($keyword);
        } else {
            $pengandangan = $this->pengandanganModel->getDataKendaraan();
        }

        $data = [
            'title' => 'Data Kendaraan',
            'pengandangan' => $pengandangan["pengandangan"]->paginate(5, 'pengandangan'),
            'pager' => $pengandangan['pengandangan']->pager,
            'currentPage' => $currentPage
        ];

        return view('operator/pengandangan', $data);
    }
}
