<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\Petugas\BapModel;

class BapController extends BaseController
{

    protected $bapModel;

    public function __construct()
    {
        $this->bapModel = new BapModel();
    }

    public function index()
    {

        $currentPage = $this->request->getVar('page_bap') ? $this->request->getVar('page_bap') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $noBap = $this->bapModel->search($keyword, session('unit_id'));
        } else {
            $noBap = $this->bapModel->getDataBap(session('unit_id'));
        }
        $data = [
            'title' => 'Berita Acara Penindakan',
            'dataBap' => $noBap["bap"]->paginate(10, 'bap'),
            'pager' => $noBap["bap"]->pager,
            'currentPage' => $currentPage
        ];

        return view('petugas/bap', $data);
    }
}
