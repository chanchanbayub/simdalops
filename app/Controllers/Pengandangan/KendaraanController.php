<?php

namespace App\Controllers\Pengandangan;

use App\Controllers\BaseController;
use App\Models\Admin\PasalPelanggaranModel;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Operator\BapModel;
use App\Models\Pengandangan\PengandanganModel;
use App\Models\Pengandangan\LaporanPenindakanModel;

class KendaraanController extends BaseController
{
    protected $laporanPenindakanModel;
    protected $typeKendaraanModel;
    protected $pasalPelanggaranModel;
    protected $pengandanganModel;
    protected $validation;
    protected $bapModel;

    public function __construct()
    {
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->pasalPelanggaranModel = new PasalPelanggaranModel();
        $this->pengandanganModel = new PengandanganModel();
        $this->validation = \Config\Services::validation();
        $this->bapModel = new BapModel();
    }

    public function index()
    {
        $now = date('Y-m-d');

        $currentPage = $this->request->getVar('page_pengandangan') ? $this->request->getVar('page_pengandangan') : 1;

        $laporanPenindakan = $this->laporanPenindakanModel->getPenindakan($now, session('pool_id'), session('ukpd_id'));

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $kendaraan = $this->pengandanganModel->search($keyword);
        } else {
            $kendaraan = $this->pengandanganModel->getDataKendaraanPengandangan($now);
        }

        $data = [
            'title' => 'Data Kendaraan Masuk',
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
            'kendaraan' => $this->typeKendaraanModel->findAll(),
            'laporanPenindakan' => $laporanPenindakan['laporan_penindakan']->get()->getResultArray(),
            'pengandangan' => $kendaraan["pengandangan"]->paginate(5, 'pengandangan'),
            'pager' => $kendaraan["pengandangan"]->pager,
            'currentPage' => $currentPage
        ];

        return view('pengandangan/kendaraan_masuk', $data);
    }

    public function kendaraanKeluar()
    {

        $now = date('Y-m-d');

        $currentPage = $this->request->getVar('page_pengandangan') ? $this->request->getVar('page_pengandangan') : 1;

        $laporanPenindakan = $this->laporanPenindakanModel->getPenindakan($now, session('pool_id'), session('ukpd_id'));

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $kendaraan = $this->pengandanganModel->getKendaraanKeluar($keyword);
        } else {
            $kendaraan = $this->pengandanganModel->getKendaraanKeluar();
        }

        $data = [
            'title' => 'Data Kendaraan Keluar',
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
            'kendaraan' => $this->typeKendaraanModel->findAll(),
            'laporanPenindakan' => $laporanPenindakan['laporan_penindakan']->get()->getResultArray(),
            'pengandangan' => $kendaraan["pengandangan"]->paginate(5, 'pengandangan'),
            'pager' => $kendaraan["pengandangan"]->pager,
            'currentPage' => $currentPage
        ];


        return view('pengandangan/kendaraan_keluar', $data);
    }

    public function getPenindakan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            return json_encode($laporanPenindakan);
        }
    }

    public function data_kendaraan()
    {
        $currentPage = $this->request->getVar('page_pengandangan') ? $this->request->getVar('page_pengandangan') : 1;


        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $kendaraan = $this->pengandanganModel->search($keyword);
        } else {
            $kendaraan = $this->pengandanganModel->getDataKendaraanPengandangan();
        }

        $data = [
            'title' => 'Data Kendaraan',
            'pengandangan' => $kendaraan["pengandangan"]->paginate(5, 'pengandangan'),
            'currentPage' =>  $currentPage,
            'pager' => $kendaraan["pengandangan"]->pager
        ];

        return view('pengandangan/data_kendaraan', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'laporan_penindakan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Kendaraan Harus di Isi!'
                    ]
                ],
                'foto_kendaraan_masuk' => [
                    'rules' => 'uploaded[foto_kendaraan_masuk]|is_image[foto_kendaraan_masuk]|max_size[foto_kendaraan_masuk,5024]',
                    'errors' => [
                        'uploaded' => 'Foto Penindakan Tidak Boleh Kosong!',
                        'max_size' => 'Ukuran Foto Tidak Boleh Lebih dari 5mb!',
                        'is_image' => 'Yang Anda Upload Bukan Foto!',
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'laporan_penindakan_id' => $this->validation->getError('laporan_penindakan_id'),
                        'foto_kendaraan_masuk' => $this->validation->getError('foto_kendaraan_masuk'),
                    ]
                ];
            } else {
                $laporan_penindakan_id = $this->request->getVar('laporan_penindakan_id');
                $foto_kendaraan_masuk = $this->request->getFile('foto_kendaraan_masuk');
                $bap_id = $this->request->getVar('bap_id');

                $namaFoto = $foto_kendaraan_masuk->getRandomName();
                $foto_kendaraan_masuk->move('kendaraan/', $namaFoto);


                $this->pengandanganModel->save([
                    'laporan_penindakan_id' => $laporan_penindakan_id,
                    'status_kendaraan' => 'Masuk',
                    'foto_kendaraan_masuk' => $namaFoto
                ]);
                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => 3
                ]);

                $messeage = [
                    'success' => 'Kendaraan Berhasil di Simpan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $kendaraan = $this->pengandanganModel->getKendaraanId($id);

            return json_encode($kendaraan);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'foto_kendaraan_keluar' => [
                    'rules' => 'uploaded[foto_kendaraan_keluar]|is_image[foto_kendaraan_keluar]|max_size[foto_kendaraan_keluar,2048]',
                    'errors' => [
                        'uploaded' => 'Foto Penindakan Tidak Boleh Kosong!',
                        'max_size' => 'Ukuran Foto Tidak Boleh Lebih dari 2mb!',
                        'is_image' => 'Yang Anda Upload Bukan Foto!',
                    ],
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'foto_kendaraan_keluar' => $this->validation->getError('foto_kendaraan_keluar'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $foto_kendaraan_keluar = $this->request->getFile('foto_kendaraan_keluar');

                $namaFoto = $foto_kendaraan_keluar->getRandomName();
                $foto_kendaraan_keluar->move('kendaraan/', $namaFoto);


                $this->pengandanganModel->update($id, [
                    'id' => $id,
                    'status_kendaraan' => 'Keluar',
                    'tanggal_keluar' => date('Y-m-d'),
                    'foto_kendaraan_keluar' => $namaFoto
                ]);


                $messeage = [
                    'success' => 'Kendaraan Berhasil di Simpan!'
                ];
            }
            return json_encode($messeage);
        }
    }
}
