<?php

namespace App\Controllers\Operator;


use App\Controllers\BaseController;
use App\Models\Admin\JenisPelanggaranModel;
use App\Models\Admin\KendaraanModel;
use App\Models\Admin\LokasiSidangModel;
use App\Models\Admin\PasalPelanggaranModel;
use App\Models\Admin\PenindakanModel;
use App\Models\Admin\PoolPenyimpananModel;
use App\Models\Admin\StatusBapModel;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Admin\UnitPenindakModel;
use App\Models\Operator\BapModel;
use App\Models\Operator\LaporanPenindakanModel;
use Exception;

class LaporanPenindakan extends BaseController
{

    protected $laporanPenindakanModel;
    protected $klasifikasiKendaraanModel;
    protected $typeKendaraanModel;
    protected $poolPenyimpananModel;
    protected $jenisPenindakanModel;
    protected $unitPenindakModel;
    protected $statusBapModel;
    protected $bapModel;
    protected $lokasiSidangModel;
    protected $pasalPelanggaranModel;
    protected $jenisPelanggaranModel;
    protected $validation;

    public function __construct()
    {
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->klasifikasiKendaraanModel = new KendaraanModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->poolPenyimpananModel = new PoolPenyimpananModel();
        $this->jenisPenindakanModel = new PenindakanModel();
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->bapModel = new BapModel();
        $this->statusBapModel = new StatusBapModel();
        $this->lokasiSidangModel = new LokasiSidangModel();
        $this->pasalPelanggaranModel = new PasalPelanggaranModel();
        $this->jenisPelanggaranModel = new JenisPelanggaranModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $now = date('Y-m-d');

        $currentPage = $this->request->getVar('page_laporan_penindakan') ? $this->request->getVar('page_laporan_penindakan') : 1;

        $keyword = $this->request->getVar('keyword');

        $tanggal_penindakan = $this->request->getVar('tanggal_penindakan');

        if ($keyword) {
            $laporanPenindakan = $this->laporanPenindakanModel->search($keyword);
        } else if ($tanggal_penindakan) {
            $laporanPenindakan = $this->laporanPenindakanModel->search($tanggal_penindakan);
        } else {
            $laporanPenindakan = $this->laporanPenindakanModel->getLaporanPenindakan();
        }

        $data = [
            'title' => 'Laporan Data Penindakan',
            'laporanPenindakan' => $laporanPenindakan["laporan_penindakan"]->paginate(5, 'laporan_penindakan'),
            'pager' => $laporanPenindakan["laporan_penindakan"]->pager,
            'currentPage' => $currentPage,
            'unit_penindak' => $this->unitPenindakModel->findAll(),
            'jenis_penindakan' => $this->jenisPenindakanModel->findAll(),
            'klasifikasi_kendaraan' =>  $this->klasifikasiKendaraanModel->find(),
            'type_kendaraan' => $this->typeKendaraanModel->findAll(),
            'status_bap' => $this->statusBapModel->findAll(),
            'pool_penyimpanan' => $this->poolPenyimpananModel->findAll(),
            'lokasi_sidang' => $this->lokasiSidangModel->where(["ukpd_id" => session('ukpd_id')])->findAll(),
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
            'totalBap' => $this->laporanPenindakanModel->getBapTilang('Tilang Dishub', $now),
            'totalSO' => $this->laporanPenindakanModel->getBapTilang('Stop Operasi', $now),
            'tanggal_filter' => $tanggal_penindakan
        ];

        return view('operator/data_penindakan', $data);
    }

    public function getBap()
    {
        if ($this->request->isAJAX()) {
            $bap_id = $this->request->getVar('bap_id');

            $messeage = $this->bapModel->where(["id" => $bap_id])->first();

            return json_encode($messeage);
        }
    }

    public function getPool()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            // dd($id);

            $penindakan_id = $this->request->getPost('penindakan_id');

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            $pool = $this->poolPenyimpananModel->where(["penindakan_id" => $penindakan_id])->findAll();

            $data = [
                'pool' => $pool,
                'laporanPenindakan' => $laporanPenindakan
            ];

            return json_encode($data);
        }
    }

    public function getTypeKendaraan()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $klasifikasi = $this->request->getVar('klasifikasi_id');

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            $type_kendaraan = $this->typeKendaraanModel->where(["klasifikasi_id" => $klasifikasi])->findAll();

            $data = [
                'laporanPenindakan' => $laporanPenindakan,
                'type_kendaraan' => $type_kendaraan
            ];

            return json_encode($data);
        }
    }

    public function tambah_penindakan()
    {
        $data = [
            'title' => 'Tambah Data Penindakan',
            'noBap' => $this->bapModel->where(["status_id" => 1])->findAll(),
            'unit_penindak' => $this->unitPenindakModel->findAll(),
            'jenis_penindakan' => $this->jenisPenindakanModel->findAll(),
            'klasifikasi_kendaraan' =>  $this->klasifikasiKendaraanModel->find(),
            'type_kendaraan' => $this->typeKendaraanModel->findAll(),
            'status_bap' => $this->statusBapModel->findAll(),
            'pool_penyimpanan' => $this->poolPenyimpananModel->findAll(),
            'lokasi_sidang' => $this->lokasiSidangModel->where(["ukpd_id" => session('ukpd_id')])->findAll(),
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
        ];

        return view('operator/tambah_penindakan', $data);
    }

    public function add()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'bap_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor BAP Tidak Boleh Kosong!'
                    ]
                ],
                'penindakan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Penindakan Tidak Boleh Kosong!'
                    ]
                ],
                'klasifikasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'type_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'tanggal_penindakan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Penindakan Tidak Boleh Kosong!'
                    ]
                ],
                'jam_penindakan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Penindakan Tidak Boleh Kosong!'
                    ]
                ],
                'tanggal_sidang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Sidang Tidak Boleh Kosong!'
                    ]
                ],
                'lokasi_sidang_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Sidang Tidak Boleh Kosong!'
                    ]
                ],

                'nopol' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'pasal_pelanggaran_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pasal Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'lokasi_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'barang_bukti' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Barang Bukti Tidak Boleh Kosong!'
                    ]
                ],
                'pool_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pool Pengandangan Tidak Boleh Kosong!'
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|max_size[foto,5000]',
                    'errors' => [
                        'uploaded' => 'Foto Penindakan Tidak Boleh Kosong!',
                        'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 5mb'
                    ]
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'bap_id' => $this->validation->getError('bap_id'),
                        'penindakan_id' => $this->validation->getError('penindakan_id'),
                        'klasifikasi_id' => $this->validation->getError('klasifikasi_id'),
                        'type_kendaraan_id' => $this->validation->getError('type_kendaraan_id'),
                        'tanggal_penindakan' => $this->validation->getError('tanggal_penindakan'),
                        'jam_penindakan' => $this->validation->getError('jam_penindakan'),
                        'tanggal_sidang' => $this->validation->getError('tanggal_sidang'),
                        'lokasi_sidang_id' => $this->validation->getError('lokasi_sidang_id'),
                        'nopol' => $this->validation->getError('nopol'),
                        'pasal_pelanggaran_id' => $this->validation->getError('pasal_pelanggaran_id'),
                        'lokasi_pelanggaran' => $this->validation->getError('lokasi_pelanggaran'),
                        'barang_bukti' => $this->validation->getError('barang_bukti'),
                        'pool_id' => $this->validation->getError('pool_id'),
                        'foto' => $this->validation->getError('foto'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getVar('ukpd_id');
                $penindakan_id = $this->request->getVar('penindakan_id');
                $klasifikasi_id = $this->request->getVar('klasifikasi_id');
                $type_kendaraan_id = $this->request->getVar('type_kendaraan_id');
                $tanggal_penindakan = $this->request->getVar('tanggal_penindakan');
                $jam_penindakan = $this->request->getVar('jam_penindakan');
                $tanggal_sidang = $this->request->getVar('tanggal_sidang');
                $lokasi_sidang_id = $this->request->getVar('lokasi_sidang_id');
                $nopol = $this->request->getVar('nopol');
                $lokasi_pelanggaran = $this->request->getVar('lokasi_pelanggaran');

                $pasal_pelanggaran_id = $this->request->getVar('pasal_pelanggaran_id');
                $barang_bukti = $this->request->getVar('barang_bukti');
                $pool_id = $this->request->getVar('pool_id');
                $nomor_rangka = $this->request->getVar('nomor_rangka');
                $nama_pelanggar = $this->request->getVar('nama_pelanggar');
                $alamat_pelanggar = $this->request->getVar('alamat_pelanggar');
                $warna_tnkb = $this->request->getVar('warna_tnkb');
                $tahun_perakitan = $this->request->getVar('tahun_perakitan');
                $nama_pemilik = $this->request->getVar('nama_pemilik');
                $alamat_pemilik = $this->request->getVar('alamat_pemilik');
                $catatan = $this->request->getVar('catatan');
                $foto = $this->request->getFile('foto');

                $bap_id = $this->request->getVar('bap_id');
                $status_id = $this->request->getVar('status_id');
                // dd($status_id);
                $nama_foto = $foto->getRandomName();
                $foto->move('foto-penindakan/', $nama_foto);


                // $status_id = $this->request->getVar('status_id');

                // dd($bap_id);

                $this->laporanPenindakanModel->save([
                    'ukpd_id' => $ukpd_id,
                    'bap_id' => $bap_id,
                    'penindakan_id' => $penindakan_id,
                    'klasifikasi_id' => $klasifikasi_id,
                    'kendaraan_id' => $type_kendaraan_id,
                    'tanggal_penindakan' => $tanggal_penindakan,
                    'jam_penindakan' => $jam_penindakan,
                    'tanggal_sidang' => $tanggal_sidang,
                    'lokasi_sidang_id' => ucwords($lokasi_sidang_id),
                    'tanggal_masuk_bap' => date('Y-m-d'),
                    'nopol' =>  strtoupper($nopol),
                    'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                    'pasal_pelanggaran_id' => strtoupper($pasal_pelanggaran_id),
                    'barang_bukti' => ucwords($barang_bukti),
                    'pool_id' => $pool_id,
                    'nomor_rangka' => strtoupper($nomor_rangka),
                    'nama_pelanggar' => ucwords($nama_pelanggar),
                    'alamat_pelanggar' => ucwords($alamat_pelanggar),
                    'warna_tnkb' => $warna_tnkb,
                    'tahun_perakitan' => $tahun_perakitan,
                    'nama_pemilik' => ucwords($nama_pemilik),
                    'alamat_pemilik' => ucwords($alamat_pemilik),
                    'catatan' => $catatan,
                    'foto' => $nama_foto
                ]);

                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => $status_id
                ]);

                $messeage = [
                    'success' => 'Data Penindakan Berhasil di Tambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kendaraan = $this->laporanPenindakanModel->getDataPenindakan($id);

            return json_encode($kendaraan);
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
                'klasifikasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'type_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'tanggal_sidang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Sidang Tidak Boleh Kosong!'
                    ]
                ],
                'lokasi_sidang_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Sidang Tidak Boleh Kosong!'
                    ]
                ],

                'nopol' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'pasal_pelanggaran_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pasal Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'lokasi_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'barang_bukti' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Barang Bukti Tidak Boleh Kosong!'
                    ]
                ],
                'pool_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pool Pengandangan Tidak Boleh Kosong!'
                    ]
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'penindakan_id' => $this->validation->getError('penindakan_id'),
                        'klasifikasi_id' => $this->validation->getError('klasifikasi_id'),
                        'type_kendaraan_id' => $this->validation->getError('type_kendaraan_id'),
                        'tanggal_sidang' => $this->validation->getError('tanggal_sidang'),
                        'lokasi_sidang_id' => $this->validation->getError('lokasi_sidang_id'),
                        'nopol' => $this->validation->getError('nopol'),
                        'pasal_pelanggaran_id' => $this->validation->getError('pasal_pelanggaran_id'),
                        'lokasi_pelanggaran' => $this->validation->getError('lokasi_pelanggaran'),
                        'barang_bukti' => $this->validation->getError('barang_bukti'),
                        'pool_id' => $this->validation->getError('pool_id'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $penindakan_id = $this->request->getVar('penindakan_id');
                $klasifikasi_id = $this->request->getVar('klasifikasi_id');
                $kendaraan_id = $this->request->getVar('type_kendaraan_id');
                $tanggal_penindakan = $this->request->getVar('tanggal_penindakan');
                $tanggal_sidang = $this->request->getVar('tanggal_sidang');
                $lokasi_sidang_id = $this->request->getVar('lokasi_sidang_id');
                $nopol = $this->request->getVar('nopol');
                $lokasi_pelanggaran = $this->request->getVar('lokasi_pelanggaran');

                $pasal_pelanggaran_id = $this->request->getVar('pasal_pelanggaran_id');
                $barang_bukti = $this->request->getVar('barang_bukti');
                $pool_id = $this->request->getVar('pool_id');
                $nomor_rangka = $this->request->getVar('nomor_rangka');
                $nama_pelanggar = $this->request->getVar('nama_pelanggar');
                $alamat_pelanggar = $this->request->getVar('alamat_pelanggar');
                $warna_tnkb = $this->request->getVar('warna_tnkb');
                $tahun_perakitan = $this->request->getVar('tahun_perakitan');
                $nama_pemilik = $this->request->getVar('nama_pemilik');
                $alamat_pemilik = $this->request->getVar('alamat_pemilik');
                $catatan = $this->request->getVar('catatan');

                // $status_id = $this->request->getVar('status_id');
                $id_bap = $this->request->getVar('id_bap');
                // dd($bap_id);

                $this->laporanPenindakanModel->update($id, [
                    'id' => $id,
                    'penindakan_id' => $penindakan_id,
                    'klasifikasi_id' => $klasifikasi_id,
                    'kendaraan_id' => $kendaraan_id,
                    'tanggal_penindakan' => $tanggal_penindakan,
                    'tanggal_sidang' => $tanggal_sidang,
                    'lokasi_sidang_id' => ucwords($lokasi_sidang_id),
                    'tanggal_masuk_bap' => date('Y-m-d'),
                    'nopol' =>  strtoupper($nopol),
                    'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                    'pasal_pelanggaran_id' => strtoupper($pasal_pelanggaran_id),
                    'barang_bukti' => ucwords($barang_bukti),
                    'pool_id' => $pool_id,
                    'nomor_rangka' => strtoupper($nomor_rangka),
                    'nama_pelanggar' => ucwords($nama_pelanggar),
                    'alamat_pelanggar' => ucwords($alamat_pelanggar),
                    'warna_tnkb' => $warna_tnkb,
                    'tahun_perakitan' => $tahun_perakitan,
                    'nama_pemilik' => ucwords($nama_pemilik),
                    'alamat_pemilik' => ucwords($alamat_pemilik),
                    'catatan' => $catatan
                ]);

                $this->bapModel->update($id_bap, [
                    'id' => $id_bap,
                    'status_id' => 4
                ]);

                $messeage = [
                    'success' => 'Data Penindakan Berhasil di Update!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $laporanPenindakan = $this->laporanPenindakanModel->where(["id" => $id])->first();

            unlink("foto-penindakan/" . $laporanPenindakan["foto"]);

            $this->laporanPenindakanModel->delete($laporanPenindakan["id"]);

            $messeage = [
                'success' => 'Data Penindakan Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }

    public function detail_data($id)
    {
        $laporan_penindakan =  $this->laporanPenindakanModel->getDataPenindakan($id);

        $data = [
            'title' => 'Data Penindakan',
            'laporan_penindakan' => $laporan_penindakan,
        ];

        return view('operator/detail_penindakan', $data);
    }

    public function download($nama_foto)
    {
        $nama_foto = $this->laporanPenindakanModel->where(["foto" => $nama_foto])->first();
        if (file_exists('foto-penindakan/' . $nama_foto["foto"])) {
            return $this->response->download('foto-penindakan/' . $nama_foto["foto"], null);
        } else {
            return "<script> alert(Foto Penindakan Tidak Tersedia) </script>";
        }
    }
}
