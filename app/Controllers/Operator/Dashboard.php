<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Operator\SuratPengeluaranModel;
use DateTime;

class Dashboard extends BaseController
{
    protected $suratPengeluranModel;
    protected $date;

    public function __construct()
    {
        $this->date = new DateTime();
        $this->suratPengeluranModel = new SuratPengeluaranModel();
    }



    public function index()
    {

        if (session()->get('role_management') != 'Operator') {
            return redirect()->back();
        }


        $now = $this->date->format('Y-m-d');
        // dd($now);


        $data = [
            'title' => 'E-Tilang | Dashboard',
            'totalHarian' => $this->suratPengeluranModel->totalPengeluaran($now),
            'totalKeseluruhan' => $this->suratPengeluranModel->totalPengeluaran(),
            'totalRawaBuaya' => $this->suratPengeluranModel->getTotalPengandangan("Rawa Buaya", $now),
            'totalPuloGadung' => $this->suratPengeluranModel->getTotalPengandangan("Pulo Gadung", $now),
            'totalPuloGebang' => $this->suratPengeluranModel->getTotalPengandangan("Pulo Gebang", $now),
            'totalTanahMerdeka' => $this->suratPengeluranModel->getTotalPengandangan("Tanah Merdeka", $now),
        ];

        return view('operator/dashboard', $data);
    }
}
