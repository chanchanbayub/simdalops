<?php

namespace App\Controllers\Verifikator;

use App\Controllers\BaseController;
use App\Models\Verifikator\ProfileModel;
use App\Models\Verifikator\SuratPengeluaranModel;
use DateTime;

class Dashboard extends BaseController
{
    protected $suratPengeluaranModel;
    protected $date;
    protected $profileModel;

    public function __construct()
    {

        if (session('role_management') != 'Verifikator') {
            return redirect()->back();
        } else {

            $this->suratPengeluaranModel = new SuratPengeluaranModel();
            $this->date = new DateTime();
            $this->profileModel = new ProfileModel();
        }
    }

    public function index()
    {
        $now = $this->date->format('Y-m-d');
        // dd(session("id"));
        $data = [
            'title' => ' Dashboard | Verifikator',
            'totalHarian' => $this->suratPengeluaranModel->totalPengeluaran($now),
            'profile' => $this->profileModel->where(["users_id" => session('id')])->first(),
            'totalKeseluruhan' => $this->suratPengeluaranModel->totalPengeluaran(),
            'totalRawaBuaya' => $this->suratPengeluaranModel->totalPengandangan("Rawa Buaya", $now),
            'totalPuloGadung' => $this->suratPengeluaranModel->totalPengandangan("Pulo Gadung", $now),
            'totalPuloGebang' => $this->suratPengeluaranModel->totalPengandangan("Pulo Gebang", $now),
            'totalTanahMerdeka' => $this->suratPengeluaranModel->totalPengandangan("Tanah Merdeka", $now)
        ];
        return view('verifikator/dashboard', $data);
    }
}
