<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Admin\JenisBapModel;
use App\Models\Admin\UnitPenindakModel;
use App\Models\Operator\BapModel;
use App\Models\Operator\LaporanPenindakanModel;
use App\Models\Operator\PengandanganModel;

class BapController extends BaseController
{
    protected $validation;
    protected $bapModel;
    protected $unitPenindakanModel;
    protected $jenisBapModel;
    protected $laporanPenindakanModel;
    protected $pengandanganModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->bapModel = new BapModel();
        $this->unitPenindakanModel = new UnitPenindakModel();
        $this->jenisBapModel = new JenisBapModel();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->pengandanganModel = new PengandanganModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_bap') ? $this->request->getVar('page_bap') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $noBap = $this->bapModel->search($keyword);
        } else {
            $noBap = $this->bapModel->getNoBap();
        }

        $data = [
            'title' => 'Berita Acara Penindakan',
            'noBap' => $noBap["noBap"]->paginate(10, 'bap'),
            'pager' => $noBap["noBap"]->pager,
            'currentPage' => $currentPage,
            'unitPenindak' => $this->unitPenindakanModel->where(["ukpd_id" => session('ukpd_id')])->findAll(),
            'jenis_bap' => $this->jenisBapModel->findAll()
        ];

        return view('operator/bap', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'jenis_bap_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No BAP Harus di Isi!',
                    ]
                ],
                'noBap' => [
                    'rules' => 'required|numeric|is_unique[bap.noBap]',
                    'errors' => [
                        'required' => 'No BAP Harus di Isi!',
                        'numeric' => 'No BAP Harus Berupa Angka',
                        'is_unique' => 'No BAP Telah Terdaftar'
                    ]
                ],
                'noBapAkhir' => [
                    'rules' => 'required|numeric|is_unique[bap.noBap]',
                    'errors' => [
                        'required' => 'No BAP Akhir Harus di Isi!',
                        'numeric' => 'No BAP Akhir Berupa Angka',
                        'is_unique' => 'No BAP Telah Terdaftar'
                    ]
                ],
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit / Regu  Harus di Isi!'
                    ]
                ],
                'nama_petugas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Petugas Harus di Isi!'
                    ]
                ],

            ])) {
                $messeage = [
                    'error' => [
                        'jenis_bap_id' => $this->validation->getError('jenis_bap_id'),
                        'noBap' => $this->validation->getError('noBap'),
                        'noBapAkhir' => $this->validation->getError('noBapAkhir'),
                        'unit_id' => $this->validation->getError('unit_id'),
                        'nama_petugas' => $this->validation->getError('nama_petugas')
                    ]
                ];
            } else {

                $jenis_bap_id = $this->request->getVar('jenis_bap_id');
                $noAwal = $this->request->getVar('noBap');
                $noBapAkhir = $this->request->getVar('noBapAkhir');
                $unit_id = $this->request->getVar('unit_id');
                $nama_petugas = $this->request->getVar('nama_petugas');
                for ($i = intval($noAwal); $i <= intval($noBapAkhir); $i++) {
                    if (strlen($i) == 1) {
                        $noBap = "0000" . $i;
                    } else if (strlen($i) == 2) {
                        $noBap = "000" . $i;
                    } else if (strlen($i) == 3) {
                        $noBap = "00" . $i;
                    } else if (strlen($i) == 4) {
                        $noBap = "0" . $i;
                    }
                    $this->bapModel->save([
                        'jenis_bap_id' => $jenis_bap_id,
                        'noBap' => $noBap,
                        'unit_id' => $unit_id,
                        'nama_petugas' => ucwords($nama_petugas),
                        'status_id' => 1
                    ]);
                }
                // return json_encode($noBap);
                $messeage = [
                    'success' => 'No Bap Berhasil di Daftarkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->bapModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jenis_bap_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis BAP Harus di Isi!',
                    ]
                ],
                'noBap' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'No BAP Harus di Isi!',
                        'numeric' => 'No BAP Harus Berupa Angka',
                    ]
                ],
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit / Regu  Harus di Isi!'
                    ]
                ],
                'nama_petugas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Petugas Harus di Isi!'
                    ]
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'noBap' => $this->validation->getError('noBap'),
                        'jenis_bap_id' => $this->validation->getError('jenis_bap_id'),
                        'unit_id' => $this->validation->getError('unit_id'),
                        'nama_petugas' => $this->validation->getError('nama_petugas'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $jenis_bap_id = $this->request->getVar('jenis_bap_id');
                $noBap = $this->request->getVar('noBap');
                $unit_id = $this->request->getVar('unit_id');
                $nama_petugas = $this->request->getVar('nama_petugas');
                $this->bapModel->update($id, [
                    'id' => $id,
                    'jenis_bap_id' => $jenis_bap_id,
                    'noBap' => $noBap,
                    'unit_id' => $unit_id,
                    'nama_petugas' => $nama_petugas,
                    'status_id' => 1
                ]);

                $messeage = [
                    'success' => 'Nomor BAP Berhasil di Ubah!'
                ];
            }

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->bapModel->where(["id" => $id])->first();

            $dataPenindakan = $this->laporanPenindakanModel->where(["bap_id" => $data["id"]])->first();

            $pengandangan = $this->pengandanganModel->where(["laporan_penindakan_id" => $dataPenindakan["id"]])->first();

            if ($pengandangan != null) {
                if ($pengandangan["foto_kendaraan_masuk"] != null) {
                    $fotoKendaraanMasuk = 'kendaraan/' . $pengandangan["foto_kendaraan_masuk"];
                    if (file_exists($fotoKendaraanMasuk)) {
                        unlink($fotoKendaraanMasuk);
                    }
                }
                if ($pengandangan["foto_kendaraan_keluar"] != null) {
                    $fotoKendaraanKeluar = 'kendaraan/' . $pengandangan["foto_kendaraan_keluar"];
                    if (file_exists($fotoKendaraanKeluar)) {
                        unlink($fotoKendaraanKeluar);
                    }
                }
            }

            if ($dataPenindakan != null) {
                if ($dataPenindakan["foto"] != null) {
                    $foto_penindakan = 'foto-penindakan/' . $dataPenindakan["foto"];
                    if (file_exists($foto_penindakan)) {
                        unlink($foto_penindakan);
                    }
                }
            }

            $this->bapModel->delete($data["id"]);

            $messeage = [
                'success' => 'No Bap Berhasil di Hapus'
            ];

            return json_encode($messeage);
        }
    }
}
