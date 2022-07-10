<?php

namespace App\Controllers\Petugas;

use App\Controllers\Admin\PoolPenyimpanan;
use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\JenisPelanggaranModel;
use App\Models\Admin\Kecamatan;
use App\Models\Admin\KelurahanModel;
use App\Models\Admin\KendaraanModel;
use App\Models\Admin\Kota;
use App\Models\Admin\LokasiPenindakanModel;
use App\Models\Admin\LokasiSidangModel;
use App\Models\Admin\PasalPelanggaranModel;
use App\Models\Admin\PenindakanModel;
use App\Models\Admin\PoolPenyimpananModel;
use App\Models\Admin\Provinsi;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Petugas\BapModel;
use App\Models\Petugas\LaporanPenindakanModel;

class LaporanPenindakan extends BaseController
{
    protected $bapModel;
    protected $provinsiModel;
    protected $kotaModel;
    protected $kecamtanModel;
    protected $kelurahanModel;
    protected $validation;
    protected $laporanPenindakanModel;
    protected $pasalPelanggaranModel;
    protected $jenisPelanggaranModel;
    protected $lokasiSidangModel;
    protected $klasifikasiKendaraanModel;
    protected $JenisKendaraanModel;
    protected $poolPenyimpananModel;
    protected $typeKendaraanModel;
    protected $jenisPenindakanModel;

    protected $lokasiPenindakanModel;

    public function __construct()
    {
        $this->bapModel = new BapModel();
        $this->validation = \Config\Services::validation();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->pasalPelanggaranModel = new PasalPelanggaranModel();
        $this->jenisPelanggaranModel = new JenisPelanggaranModel();
        $this->lokasiSidangModel = new LokasiSidangModel();
        $this->klasifikasiKendaraanModel = new KendaraanModel();
        $this->JenisKendaraanModel = new JenisKendaraanModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->penindakanModel = new PenindakanModel();
        $this->poolPenyimpananModel = new PoolPenyimpananModel();
        $this->provinsiModel = new Provinsi();
        $this->kotaModel = new Kota();
        $this->kecamatanModel = new Kecamatan();
        $this->kelurahanModel = new KelurahanModel();
        $this->lokasiPenindakanModel = new LokasiPenindakanModel();
    }

    public function index()
    {


        $now = date("Y-m-d");

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $laporanPenindakan = $this->laporanPenindakanModel->search($keyword);
        } else {
            $laporanPenindakan = $this->laporanPenindakanModel->getLaporanPenindakan($now, session('unit_id'));
        }

        $currentPage = $this->request->getVar('page_laporan_penindakan') ? $this->request->getVar('page_laporan_penindakan') : 1;

        $data = [
            'title' => 'Laporan Penindakan',
            'noBap' => $this->bapModel->where(['unit_id' => session('unit_id')])->where(["status_id" => 1])->findAll(),
            'laporan_penindakan' => $laporanPenindakan["laporan_penindakan"]->paginate(5, 'laporan_penindakan'),
            'pager' => $laporanPenindakan["laporan_penindakan"]->pager,
            'currentPage' => $currentPage,
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
            'lokasi_sidang' => $this->lokasiSidangModel->findAll(),
            'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->findAll(),
            'type_kendaraan' => $this->typeKendaraanModel->findAll(),
            'jenis_penindakan' => $this->penindakanModel->findAll(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kota' => $this->kotaModel->findAll(),
            'kecamatan' => $this->kecamatanModel->findAll(),
            'kelurahan' => $this->kelurahanModel->findAll(),
            'jenis_kendaraan' => $this->JenisKendaraanModel->findAll(),
        ];

        return view('petugas/laporanPenindakan', $data);
    }

    public function add_penindakan($noBap)
    {
        $dataBap = $this->bapModel->getNoBap($noBap, session('unit_id'));

        $data = [
            'title' => 'Tambah Penindakan',
            'noBap' => $dataBap,
            'jenis_penindakan' => $this->penindakanModel->findAll(),
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
            'lokasi_sidang' => $this->lokasiSidangModel->findAll(),
            'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->findAll(),
            'jenis_kendaraan' => $this->JenisKendaraanModel->findAll(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kota' => $this->kotaModel->findAll(),
            'kecamatan' => $this->kecamatanModel->findAll(),
        ];

        if ($dataBap == null) {
            return redirect()->back();
        } else {
            return view('petugas/tambah_penindakan', $data);
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'penindakan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Penindakan Tidak Boleh Kosong!'
                    ]
                ],
                'jenis_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'klasifikasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'bap_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No BAP Tidak Boleh Kosong'
                    ],
                ],
                'nopol' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Kendaraan Tidak Boleh Kosong'
                    ],
                ],
                'pasal_pelanggaran_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pasal Pelanggaran Tidak Boleh Kosong'
                    ],
                ],
                'lokasi_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Pelanggaran Tidak Boleh Kosong'
                    ],
                ],
                'tanggal_sidang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Sidang Tidak Boleh Kosong'
                    ],
                ],
                'lokasi_sidang_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Sidang Tidak Boleh Kosong'
                    ],
                ],
                'pool_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pool Penyimpanan Tidak Boleh Kosong'
                    ],
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|is_image[foto]|max_size[foto,5000]',
                    'errors' => [
                        'uploaded' => 'Foto Kendaraan Tidak Boleh Kosong!',
                        'max_size' => 'Ukuran Foto Tidak Boleh Lebih dari 5mb!',
                        'is_image' => 'Yang Anda Upload Bukan Foto!',
                    ],
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'penindakan_id' => $this->validation->getError('penindakan_id'),
                        'jenis_kendaraan_id' => $this->validation->getError('jenis_kendaraan_id'),
                        'klasifikasi_id' => $this->validation->getError('klasifikasi_id'),
                        'kendaraan_id' => $this->validation->getError('kendaraan_id'),
                        'bap_id' => $this->validation->getError('bap_id'),
                        'nopol' => $this->validation->getError('nopol'),
                        'pasal_pelanggaran_id' => $this->validation->getError('pasal_pelanggaran_id'),
                        'lokasi_pelanggaran' => $this->validation->getError('lokasi_pelanggaran'),
                        'tanggal_sidang' => $this->validation->getError('tanggal_sidang'),
                        'lokasi_sidang_id' => $this->validation->getError('lokasi_sidang_id'),
                        'pool_id' => $this->validation->getError('pool_id'),
                        'foto' => $this->validation->getError('foto'),
                    ],
                ];
            } else {
                $ukpd_id = $this->request->getVar('ukpd_id');
                $penindakan_id = $this->request->getVar('penindakan_id');
                $jenis_kendaraan_id = $this->request->getVar('jenis_kendaraan_id');
                $klasifikasi_id = $this->request->getVar('klasifikasi_id');
                $kendaraan_id = $this->request->getVar('kendaraan_id');
                $bap_id = $this->request->getVar('bap_id');
                $nopol = $this->request->getVar('nopol');
                $pasal_pelanggaran_id = $this->request->getVar('pasal_pelanggaran_id');
                $lokasi_pelanggaran = $this->request->getVar('lokasi_pelanggaran');
                $tanggal_sidang = $this->request->getVar('tanggal_sidang');
                $lokasi_sidang_id = $this->request->getVar('lokasi_sidang_id');
                $pool_id = $this->request->getVar('pool_id');
                $nama_pelanggar = $this->request->getVar('nama_pelanggar');
                $alamat_pelanggar = $this->request->getVar('alamat_pelanggar');
                $foto = $this->request->getFile('foto');
                // return json_encode($foto);
                $provinsi_id = $this->request->getVar('provinsi_id');
                $kota_id = $this->request->getVar('kota_id');
                $kecamatan_id = $this->request->getVar('kecamatan_id');
                $kelurahan_id = $this->request->getVar('kelurahan_id');
                $keterangan = $this->request->getVar('keterangan');

                $namaFoto = $foto->getRandomName();

                $foto->move('foto-penindakan/', $namaFoto);

                $this->laporanPenindakanModel->save([
                    'ukpd_id' => $ukpd_id,
                    'penindakan_id' => $penindakan_id,
                    'jenis_kendaraan_id' => $jenis_kendaraan_id,
                    'klasifikasi_id' => $klasifikasi_id,
                    'kendaraan_id' => $kendaraan_id,
                    'bap_id' => $bap_id,
                    'nopol' => strtoupper($nopol),
                    'pasal_pelanggaran_id' => $pasal_pelanggaran_id,
                    'tanggal_sidang' => $tanggal_sidang,
                    'lokasi_sidang_id' => $lokasi_sidang_id,
                    'pool_id' => $pool_id,
                    'tanggal_penindakan' => date('Y-m-d'),
                    'jam_penindakan' => date('H:i:s'),
                    'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                    'tanggal_masuk_bap' => date('Y-m-d'),
                    'nama_pelanggar' => ucwords($nama_pelanggar),
                    'alamat_pelanggar' => ucwords($alamat_pelanggar),
                    'foto' => $namaFoto
                ]);

                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => 2
                ]);

                $this->lokasiPenindakanModel->save([
                    'bap_id' => $bap_id,
                    'provinsi_id' => $provinsi_id,
                    'kota_id' => $kota_id,
                    'kecamatan_id' => $kecamatan_id,
                    'kelurahan_id' => $kelurahan_id,
                    'keterangan' => $keterangan
                ]);

                $messeage = [
                    'success' => 'Laporan Penindakan Berhasil diitambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function getPoolPenyimpanan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $penindakan_id = $this->request->getVar('penindakan_id');

            $pool_penyimpanan = $this->poolPenyimpananModel->where(["penindakan_id" => $penindakan_id])->findAll();

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            $data = [
                'pool_penyimpanan' => $pool_penyimpanan,
                'laporanPenindakan' => $laporanPenindakan
            ];

            return json_encode($data);
        }
    }

    public function getKlasifikasiKendaraan()
    {
        if ($this->request->isAJAX()) {
            $jenis_kendaraan_id = $this->request->getVar('jenis_kendaraan_id');

            // $klasifikasi_id = $this->request->getVar('klasifikasi_id');

            // $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            $klasifikasi_kendaraan = $this->klasifikasiKendaraanModel->where(["jenis_kendaraan_id" => $jenis_kendaraan_id])->findAll();

            $data = [
                'klasifikasi_kendaraan' => $klasifikasi_kendaraan,
                // 'laporanPenindakan' => $laporanPenindakan
            ];
            return json_encode($data);
        }
    }

    public function getTypeKendaraan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $klasifikasi_id = $this->request->getVar('klasifikasi_id');

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            $typeKendaraan = $this->typeKendaraanModel->where(["klasifikasi_id" => $klasifikasi_id])->findAll();

            $data = [
                'type_kendaraan' => $typeKendaraan,
                'laporanPenindakan' => $laporanPenindakan
            ];
            return json_encode($data);
        }
    }

    public function getKota()
    {
        if ($this->request->isAJAX()) {
            $provinsi_id = $this->request->getVar('id');

            $kota_id = $this->kotaModel->where(["provinsi_id" => $provinsi_id])->findAll();

            return json_encode($kota_id);
        }
    }

    public function getKecamatan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $kecamatan_id = $this->kecamatanModel->where(["kabkot_id" => $id])->findAll();

            return json_encode($kecamatan_id);
        }
    }

    public function getKelurahan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $kelurahan_id = $this->kelurahanModel->where(["kecamatan_id" => $id])->findAll();

            return json_encode($kelurahan_id);
        }
    }

    public function editData()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $data = $this->laporanPenindakanModel->getDataPenindakan($id);

            $lokasi_penindakan = $this->lokasiPenindakanModel->where(["bap_id" => $data["bap_id"]])->first();

            $data = [
                'laporanPenindakan' => $data,
                'lokasi_penindakan' => $lokasi_penindakan
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            unlink("foto-penindakan/" . $laporanPenindakan["foto"]);

            $this->laporanPenindakanModel->delete($laporanPenindakan["id"]);

            $messeage = [
                'success' => 'Data Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $bap_id = $this->request->getVar('bap_id');
            $penindakan_id = $this->request->getPost('penindakan_id');
            $klasifikasi_id = $this->request->getVar('klasifikasi_id');
            $kendaraan_id = $this->request->getVar('kendaraan_id');
            $nopol = $this->request->getVar('nopol');
            $pasal_pelanggaran_id = $this->request->getVar('pasal_pelanggaran_id');
            $lokasi_pelanggaran = $this->request->getVar('lokasi_pelanggaran');
            $tanggal_sidang = $this->request->getVar('tanggal_sidang');
            $lokasi_sidang_id = $this->request->getVar('lokasi_sidang_id');
            $pool_id = $this->request->getVar('pool_id');
            $nama_pelanggar = $this->request->getVar('nama_pelanggar');
            $alamat_pelanggar = $this->request->getVar('alamat_pelanggar');

            $this->laporanPenindakanModel->update($id, [
                'id' => $id,
                'bap_id' => $bap_id,
                'penindakan_id' => $penindakan_id,
                'klasifikasi_id' => $klasifikasi_id,
                'kendaraan_id' => $kendaraan_id,
                'nopol' => strtoupper($nopol),
                'pasal_pelanggaran_id' => $pasal_pelanggaran_id,
                'tanggal_sidang' => $tanggal_sidang,
                'lokasi_sidang_id' => $lokasi_sidang_id,
                'pool_id' => $pool_id,
                'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                'tanggal_masuk_bap' => date('Y-m-d'),
                'nama_pelanggar' => ucwords($nama_pelanggar),
                'alamat_pelanggar' => ucwords($alamat_pelanggar),
            ]);

            $messeage = [
                'success' => 'Data Berhasil di Update!'
            ];

            return json_encode($messeage);
        }
    }

    public function view($id)
    {
        $laporanPenindakan = $this->laporanPenindakanModel->getDataPenindakan($id);

        $data = [
            'laporan_penindakan' => $laporanPenindakan
        ];

        return view('petugas/view', $data);
    }
}
