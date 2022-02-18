<?php

namespace App\Controllers\Kasie;

use App\Controllers\BaseController;
use App\Models\Kasie\ProfileModel;
use App\Models\Kasie\SuratPengeluaranModel;
use DateTime;

class Dashboard extends BaseController
{
    protected $suratPengeluaranModel;
    protected $date;
    protected $profileModel;

    public function __construct()
    {
        if (session('role_management') != "Kepala Seksi") {
            return redirect()->back();
        } elseif (session('role_management') == "Kepala Seksi") {
            $this->suratPengeluaranModel = new SuratPengeluaranModel();
            $this->date = new DateTime();
            $this->profileModel = new ProfileModel();
        }
    }

    public function index()
    {

        $now = $this->date->format('Y-m-d');

        $data = [
            'title' => 'E-Tilang | Dashboard',
            'profile' => $this->profileModel->where(["users_id" => session('id')])->first(),
            'totalHarian' => $this->suratPengeluaranModel->totalPengeluaran($now),
            'totalKeseluruhan' => $this->suratPengeluaranModel->totalPengeluaran(),
            'totalRawaBuaya' => $this->suratPengeluaranModel->totalPengandangan("Rawa Buaya", $now),
            'totalPuloGadung' => $this->suratPengeluaranModel->totalPengandangan("Pulo Gadung", $now),
            'totalPuloGebang' => $this->suratPengeluaranModel->totalPengandangan("Pulo Gebang", $now),
            'totalTanahMerdeka' => $this->suratPengeluaranModel->totalPengandangan("Tanah Merdeka", $now),

        ];

        return view('kasie/dashboard', $data);
    }
}
