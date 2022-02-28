<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Admin\UnitPenindakModel;
use App\Models\Operator\BapModel;
use App\Models\Operator\SuratPengeluaranModel;
use DateTime;

class Dashboard extends BaseController
{
    protected $suratPengeluranModel;
    protected $date;
    protected $bapModel;
    protected $unitPenindakModel;

    public function __construct()
    {
        $this->date = new DateTime();
        $this->suratPengeluranModel = new SuratPengeluaranModel();
        $this->bapModel = new BapModel();
        $this->unitPenindakModel = new UnitPenindakModel();
    }

    public function index()
    {

        if (session()->get('role_management') != 'Operator') {
            return redirect()->back();
        }


        $now = $this->date->format('Y-m-d');
        // dd($now);
        $unit = $this->unitPenindakModel->findAll();

        // foreach ($unit as $unit) {
        //     $regu = $this->bapModel->getBapKeluar($unit["unit_penindak"], '1');
        // }
        // dd($regu);
        $data = [
            'title' => 'E-Tilang | Dashboard',
            'totalHarian' => $this->suratPengeluranModel->totalPengeluaran($now),
            'totalKeseluruhan' => $this->suratPengeluranModel->totalPengeluaran(),
            'totalRawaBuaya' => $this->suratPengeluranModel->getTotalPengandangan("Rawa Buaya", $now),
            'totalPuloGadung' => $this->suratPengeluranModel->getTotalPengandangan("Pulo Gadung", $now),
            'totalPuloGebang' => $this->suratPengeluranModel->getTotalPengandangan("Pulo Gebang", $now),
            'totalTanahMerdeka' => $this->suratPengeluranModel->getTotalPengandangan("Tanah Merdeka", $now),
            'unit_13' => $this->bapModel->getBapKeluar('1.3', '1'),
            'unit_14' => $this->bapModel->getBapKeluar('1.4', '1'),
            'unit_15' => $this->bapModel->getBapKeluar('1.5', '1'),
            'unit_16' => $this->bapModel->getBapKeluar('1.6', '1'),
            'unit_17' => $this->bapModel->getBapKeluar('1.7', '1'),
            'unit_18' => $this->bapModel->getBapKeluar('1.8', '1')
        ];

        return view('operator/dashboard', $data);
    }
}
