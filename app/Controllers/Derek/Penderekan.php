<?php

namespace App\Controllers\Derek;

use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\Kecamatan;
use App\Models\Admin\KelurahanModel;
use App\Models\Admin\KendaraanModel;
use App\Models\Admin\Kota;
use App\Models\Admin\PenindakanModel;
use App\Models\Admin\PoolPenyimpananModel;
use App\Models\Admin\Provinsi;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Derek\BapDerekModel;
use App\Models\Derek\PenderekanModel;
use App\Models\Operator\BapModel;

class Penderekan extends BaseController
{

    protected $bapDerekModel;
    protected $bapModel;
    protected $provinsiModel;
    protected $kotaModel;
    protected $kecamtanModel;
    protected $kelurahanModel;
    protected $validation;

    protected $klasifikasiKendaraanModel;
    protected $JenisKendaraanModel;
    protected $poolPenyimpananModel;
    protected $typeKendaraanModel;
    protected $jenisPenindakanModel;
    protected $penderekanModel;

    public function __construct()
    {
        $this->bapDerekModel = new BapDerekModel();
        $this->bapModel = new BapModel();
        $this->validation = \Config\Services::validation();
        $this->klasifikasiKendaraanModel = new KendaraanModel();
        $this->JenisKendaraanModel = new JenisKendaraanModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->penindakanModel = new PenindakanModel();
        $this->poolPenyimpananModel = new PoolPenyimpananModel();
        $this->provinsiModel = new Provinsi();
        $this->kotaModel = new Kota();
        $this->kecamatanModel = new Kecamatan();
        $this->kelurahanModel = new KelurahanModel();
        $this->penderekanModel = new PenderekanModel();
    }
    public function index()
    {
        $now = date('Y-m-d');
        $penderekan = $this->penderekanModel->getPenderekan();
        // dd($penderekan);
        // dd(session('unit_id'));
        $data = [
            'title' => 'Data Penderekan',
            'penderekan' => $penderekan

        ];

        return view('derek/penderekan', $data);
    }

    public function search()
    {
        if ($this->request->isAJAX()) {

            $keyword = $this->request->getVar('keyword');

            $data = $this->penderekanModel->search($keyword);

            return json_encode($data);
        }
    }
}
