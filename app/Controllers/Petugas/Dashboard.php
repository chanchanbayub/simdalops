<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\Petugas\BapModel;
use App\Models\Petugas\LaporanPenindakanModel;
use DateTime;

class Dashboard extends BaseController
{

    protected $bapModel;
    protected $laporanPenindakanModel;
    // protected $date;

    public function __construct()
    {
        $this->bapModel = new BapModel();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        // $this->date = new DateTime('Y-m-d');
    }

    public function index()
    {
        $now = date('Y-m-d');
    // dd(session('unit_id'));
        $data = [
            'title' => 'Dashboard Penindakan',
            'totalBap' => $this->bapModel->totalBAP(session('unit_id')),
            'totalBapKeluar' => $this->bapModel->totalBapKeluar(session('unit_id')),
            'totalBapAktif' => $this->bapModel->totalBapAktif(session('unit_id')),
            'totalBapMasuk' => $this->bapModel->totalBapMasuk(session('unit_id')),
            'jumlahPenindakan' => $this->laporanPenindakanModel->totalPerRegu(session('unit_id'), $now),

        ];

        return view('petugas/dashboard', $data);
    }
}
