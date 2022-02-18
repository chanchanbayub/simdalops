<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Admin\LokasiSidangModel;
use App\Models\Admin\UkpdModel;
use App\Models\Operator\LaporanPenindakanModel;

class PengantarSidang extends BaseController
{
    protected $laporanPenindakanModel;
    protected $ukpdModel;
    protected $lokasiSidangModel;

    public function __construct()
    {
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->ukpdModel = new UkpdModel();
        $this->lokasiSidangModel = new LokasiSidangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengantar Sidang ',
            'ukpd' => $this->ukpdModel->findAll(),
            'lokasi_sidang' => $this->lokasiSidangModel->where(["ukpd_id" => session('ukpd_id')])->findAll()
        ];

        return view('operator/pengantar_sidang', $data);
    }

    public function getPenindakanByUkpd()
    {
        if ($this->request->isAJAX()) {

            $ukpd_id = $this->request->getVar('ukpd_id');

            $tanggal_sidang = $this->request->getVar('tanggal_sidang');

            $lokasi_sidang = $this->request->getVar('lokasi_sidang_id');
            // dd(lok)


            $sidang = $this->laporanPenindakanModel->getDataSidang($ukpd_id, $tanggal_sidang, $lokasi_sidang);

            return json_encode($sidang);
        }
    }
}
