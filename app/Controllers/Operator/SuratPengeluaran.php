<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Admin\PoolPenyimpananModel;
use App\Models\Admin\RoleManagementModel;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Admin\UkpdModel;
use App\Models\Operator\BapModel;
use App\Models\Operator\LaporanPenindakanModel;
use App\Models\Operator\SuratPengeluaranModel;
use App\Models\Verifikator\ProfileModel;
use DateTime;

class SuratPengeluaran extends BaseController
{

    protected $validation;
    protected $ukpdModel;
    protected $poolPenyimpananModel;
    protected $suratPengeluaranModel;
    protected $laporanPenindakanModel;
    protected $date;
    protected $profilModel;
    protected $bapModel;
    protected $typeKendaraanModel;


    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->poolPenyimpananModel = new PoolPenyimpananModel();
        $this->suratPengeluaranModel = new SuratPengeluaranModel();
        $this->validation = \Config\Services::validation();
        $this->date = new DateTime();
        $this->profilModel = new ProfileModel();
        $this->roleManagementModel = new RoleManagementModel();
        $this->laporanPenindakanModel = new LaporanPenindakanModel();
        $this->bapModel = new BapModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_surat_pengeluaran') ? $this->request->getVar('page_surat_pengeluaran') : 1;

        $dateTime = $this->date->format('Y-m-d');

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $suratPengeluaran = $this->suratPengeluaranModel->search($keyword, $dateTime);
        } else {
            $suratPengeluaran = $this->suratPengeluaranModel->suratPengeluaranHarian($dateTime);
        }

        $data = [
            'title' => 'Surat Pengeluaran Harian',
            'suratPengeluaran' => $suratPengeluaran["suratPengeluaran"]->paginate(10, 'surat_pengeluaran'),
            'pager' => $suratPengeluaran["suratPengeluaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('operator/surat_pengeluaran_harian', $data);
    }

    public function arsipSuratPengeluaran()
    {
        $currentPage = $this->request->getVar('page_surat_pengeluaran') ? $this->request->getVar('page_surat_pengeluaran') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $suratPengeluaran = $this->suratPengeluaranModel->search($keyword);
        } else {
            $suratPengeluaran = $this->suratPengeluaranModel->arsipSuratPengeluaran();
        }

        $data = [
            'title' => 'Arsip Surat Pengeluaran',
            'suratPengeluaran' => $suratPengeluaran["suratPengeluaran"]->paginate(5, 'surat_pengeluaran'),
            'pager' => $suratPengeluaran["suratPengeluaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('operator/arsip_surat_pengeluaran', $data);
    }
    public function tambahSurat()
    {

        $noBap = $this->laporanPenindakanModel->getNoBap();
        // dd($noBap)
        // dd($noBap);
        $data = [
            'title' => 'E-Tilang | Tambah Surat Pengeluaran',
            'poolPenyimpanan' => $this->poolPenyimpananModel->findAll(),
            'ukpd' => $this->ukpdModel->findAll(),
            'noBap' => $noBap,
            'type_kendaraan' => $this->typeKendaraanModel->findAll()
        ];

        return view('operator/tambahSurat', $data);
    }

    public function saveSurat()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong!',
                    ],
                ],
                'noBap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Register BAP Tidak Boleh Kosong!',
                    ],
                ],
                'type_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nopol' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Kendaraan Tidak Boleh Kosong!'
                    ],
                ],
                'jenis_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'lokasi_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Pelanggaran Tidak Boleh Kosong!'
                    ],
                ],
                'tanggal_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'pool_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pool Penyimpanan Tidak Boleh Kosong!'
                    ]
                ],
                'tahun_perakitan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tahun Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_rangka' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Rangka Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_pemilik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pemilik Tidak Boleh Kosong!'
                    ]
                ],
                'alamat_pemilik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Pemilik Tidak Boleh Kosong!'
                    ]
                ],

                'scan_kwitansi_sidang' => [
                    'rules' => 'uploaded[scan_kwitansi_sidang]',
                    'errors' => [
                        'uploaded' => 'Kwitansi Sidang Tidak Boleh Kosong!',
                        // 'max_size' => 'Ukuran File Tidak Boleh Lebih dari 1mb'
                    ]
                ],

            ])) {
                $messeage = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'noBap' => $this->validation->getError('noBap'),
                        'type_kendaraan_id' => $this->validation->getError('type_kendaraan_id'),
                        'nopol' => $this->validation->getError('nopol'),
                        'jenis_pelanggaran' => $this->validation->getError('jenis_pelanggaran'),
                        'lokasi_pelanggaran' => $this->validation->getError('lokasi_pelanggaran'),
                        'tanggal_pelanggaran' => $this->validation->getError('tanggal_pelanggaran'),
                        'pool_id' => $this->validation->getError('pool_id'),
                        'tahun_perakitan' => $this->validation->getError('tahun_perakitan'),
                        'nomor_rangka' => $this->validation->getError('nomor_rangka'),
                        'nama_pemilik' => $this->validation->getError('nama_pemilik'),
                        'alamat_pemilik' => $this->validation->getError('alamat_pemilik'),
                        'scan_kwitansi_sidang' => $this->validation->getError('scan_kwitansi_sidang'),
                    ],
                ];
            } else {
                //Tanggal Sekarang
                $now = $this->date->format("Y-m-d");

                $ukpd_id = $this->request->getPost('ukpd_id');
                $noBap = $this->request->getPost('noBap');
                $type_kendaraan_id = $this->request->getPost('type_kendaraan_id');
                $nopol = $this->request->getPost('nopol');
                $jenis_pelanggaran = $this->request->getPost('jenis_pelanggaran');
                $lokasi_pelanggaran = $this->request->getPost('lokasi_pelanggaran');
                $tanggal_pelanggaran = $this->request->getPost('tanggal_pelanggaran');
                $pool_id = $this->request->getPost('pool_id');
                $tahun_perakitan = $this->request->getPost('tahun_perakitan');
                $nomor_rangka = $this->request->getPost('nomor_rangka');
                $nama_pemilik = $this->request->getPost('nama_pemilik');
                $alamat_pemilik = $this->request->getPost('alamat_pemilik');
                $catatan = $this->request->getPost('catatan');

                $surat_pernyataan = $this->request->getPost('surat_pernyataan');
                $surat_permohonan = $this->request->getPost('surat_permohonan');
                $scan_ktp = $this->request->getPost('scan_ktp');
                $scan_stnk = $this->request->getPost('scan_stnk');
                // files
                $scan_kwitansi_sidang = $this->request->getFile('scan_kwitansi_sidang');
                $scan_stuk = $this->request->getFile('scan_stuk');

                $scan_pengantar_sidang = $this->request->getFile('scan_pengantar_sidang');
                $scan_kartu_pengawasan = $this->request->getFile('scan_kartu_pengawasan');

                $bap_id = $this->request->getVar("bap_id");

                $nomor_surat = $this->suratPengeluaranModel->getNomorSurat($now, $pool_id);
                if ($nomor_surat["nomor"] == null) {
                    $nomor_surat = 1;
                } else {
                    $nomor_surat = (int)$nomor_surat + 1;
                }


                if ($scan_stuk->getError() == 4) {
                    $namaStuk = NULL;
                } else {
                    $namaStuk = $scan_stuk->getRandomName();
                    $scan_stuk->move('admTilang/', $namaStuk);
                }

                if ($scan_pengantar_sidang->getError() == 4) {
                    $namaPengantar = NULL;
                } else {
                    $namaPengantar = $scan_pengantar_sidang->getRandomName();
                    $scan_pengantar_sidang->move('admTilang/', $namaPengantar);
                }

                if ($scan_kartu_pengawasan->getError() == 4) {
                    $namaKps = NULL;
                } else {
                    $namaKps = $scan_kartu_pengawasan->getRandomName();
                    $scan_kartu_pengawasan->move('admTilang/', $namaKps);
                }

                $namaKwitansi = $scan_kwitansi_sidang->getRandomName();
                $scan_kwitansi_sidang->move('admTilang/', $namaKwitansi);

                $this->suratPengeluaranModel->save([
                    'ukpd_id' => ucwords($ukpd_id),
                    'noBap' => ucwords($noBap),
                    'type_kendaraan_id' => ucwords($type_kendaraan_id),
                    'nopol' => strtoupper($nopol),
                    'jenis_pelanggaran' => ucwords($jenis_pelanggaran),
                    'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                    'tanggal_pelanggaran' => $tanggal_pelanggaran,
                    'pool_id' => ucwords($pool_id),
                    'tahun_perakitan' => ucwords($tahun_perakitan),
                    'nomor_rangka' => strtoupper($nomor_rangka),
                    'nama_pemilik' => ucwords($nama_pemilik),
                    'alamat_pemilik' => ucwords($alamat_pemilik),
                    'catatan' => ucwords($catatan),
                    'tanggal_pengeluaran' => date('Y-m-d'),
                    'status_surat_id' => 1,
                    'nomor_surat' => $nomor_surat,
                    'scan_kwitansi_sidang' => $namaKwitansi,
                    'scan_pengantar_sidang' => $namaPengantar,
                    'scan_stuk' => $namaStuk,
                    'scan_kartu_pengawasan' => $namaKps,
                    'surat_permohonan' => $surat_permohonan,
                    'surat_pernyataan' => $surat_pernyataan,
                    'scan_ktp' => $scan_ktp,
                    'scan_stnk' => $scan_stnk,
                ]);

                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => 5
                ]);

                $messeage = [
                    'success' => 'Surat Pengeluaran Berhasil diTambahkan',
                    'icon' => 'success',
                    'url' => '/operator/suratPengeluaran'
                ];
            }
            return json_encode($messeage);
        }
    }
    public function ukpdData()
    {
        if ($this->request->isAJAX()) {
            $ukpd_id = $this->request->getVar('ukpd_id');

            $data = $this->ukpdModel->where(["id" => $ukpd_id])->first();

            return json_encode($data);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $noBap = $this->request->getVar('noBap');
            // dd($noBap);
            $pengeluaran = $this->suratPengeluaranModel->where(["noBap" => $noBap])->first();

            return json_encode($pengeluaran);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $noBap = $this->request->getVar('noBap');

            $data = $this->suratPengeluaranModel->where(["noBap" => $noBap])->first();
            $bap = $this->bapModel->where(["noBap" => $noBap])->first();



            $this->suratPengeluaranModel->delete($data["id"]);
            $this->bapModel->update($bap["id"], [
                'id' => $bap["id"],
                'status_id' => 3
            ]);
            $kwitansi = 'admTilang/' . $data["scan_kwitansi_sidang"];
            if (file_exists($kwitansi)) {
                unlink('admTilang/' . $data["scan_kwitansi_sidang"]);
            }

            if ($data["scan_stuk"] != NULL) {
                $stuk = 'admTilang/' . $data["scan_stuk"];
                if (file_exists($stuk)) {
                    unlink('admTilang/' . $data["scan_stuk"]);
                }
            }

            if ($data["scan_pengantar_sidang"] != NULL) {
                $pengantarSidang = 'admTilang/' . $data["scan_pengantar_sidang"];
                if (file_exists($pengantarSidang)) {
                    unlink('admTilang/' . $data["scan_pengantar_sidang"]);
                }
            }

            if ($data["scan_kartu_pengawasan"] != NULL) {
                $kartu_pengawasan = 'admTilang/' . $data["scan_kartu_pengawasan"];
                if (file_exists($kartu_pengawasan)) {
                    unlink('admTilang/' . $data["scan_kartu_pengawasan"]);
                }
            }

            $messeage = [
                'success' => 'Surat Pengeluaran Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
    public function detail_surat($id)
    {
        $pengeluaran = $this->suratPengeluaranModel->getRowResult($id);
        if ($pengeluaran > 0) {
            $profil = $this->profilModel->getProfileName("Verifikator");

            $data = [
                'title' => 'E-Tilang | Data Surat Pengeluaran',
                'pengeluaran' => $pengeluaran,
                'profil' => $profil
            ];
            return view('operator/detail_pengeluaran', $data);
        } else {
            return redirect()->back();
        }
    }

    public function editSurat($noBap)
    {

        $pengeluaran = $this->suratPengeluaranModel->where(["noBap" => $noBap])->first();
        // dd($pengeluaran);
        $data = [
            'title' => 'E-Tilang | Edit Surat Pengeluaran',
            'pengeluaran' => $pengeluaran,
            'poolPenyimpanan' => $this->poolPenyimpananModel->findAll(),
            'ukpd' => $this->ukpdModel->findAll(),
            'type_kendaraan' => $this->typeKendaraanModel->findAll()
        ];

        return view('operator/edit_surat', $data);
    }

    public function getNoBap()
    {
        if ($this->request->isAJAX()) {

            $bap_id = $this->request->getVar('bap_id');
            // dd($bap_id);

            $laporanPenindakan = $this->laporanPenindakanModel->getDataBap($bap_id);

            return json_encode($laporanPenindakan);
        }
    }

    public function update_surat()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong!',
                    ],
                ],
                'noBap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Register BAP Tidak Boleh Kosong!',
                    ],
                ],
                'type_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nopol' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Kendaraan Tidak Boleh Kosong!'
                    ],
                ],
                'jenis_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'lokasi_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Pelanggaran Tidak Boleh Kosong!'
                    ],
                ],
                'tanggal_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'pool_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pool Penyimpanan Tidak Boleh Kosong!'
                    ]
                ],
                'tahun_perakitan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tahun Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_rangka' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Rangka Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_pemilik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pemilik Tidak Boleh Kosong!'
                    ]
                ],
                'alamat_pemilik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Pemilik Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $messeage = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'noBap' => $this->validation->getError('noBap'),
                        'type_kendaraan_id' => $this->validation->getError('type_kendaraan_id'),
                        'nopol' => $this->validation->getError('nopol'),
                        'jenis_pelanggaran' => $this->validation->getError('jenis_pelanggaran'),
                        'lokasi_pelanggaran' => $this->validation->getError('lokasi_pelanggaran'),
                        'tanggal_pelanggaran' => $this->validation->getError('tanggal_pelanggaran'),
                        'pool_id' => $this->validation->getError('pool_id'),
                        'tahun_perakitan' => $this->validation->getError('tahun_perakitan'),
                        'nomor_rangka' => $this->validation->getError('nomor_rangka'),
                        'nama_pemilik' => $this->validation->getError('nama_pemilik'),
                        'alamat_pemilik' => $this->validation->getError('alamat_pemilik'),
                    ],
                ];
            } else {
                //Tanggal Sekarang
                $now = $this->date->format("Y-m-d");

                $id = $this->request->getVar('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $noBap = $this->request->getPost('noBap');
                $type_kendaraan_id = $this->request->getPost('type_kendaraan_id');
                $nopol = $this->request->getPost('nopol');
                $jenis_pelanggaran = $this->request->getPost('jenis_pelanggaran');
                $lokasi_pelanggaran = $this->request->getPost('lokasi_pelanggaran');
                $tanggal_pelanggaran = $this->request->getPost('tanggal_pelanggaran');
                $pool_id = $this->request->getPost('pool_id');
                $tahun_perakitan = $this->request->getPost('tahun_perakitan');
                $nomor_rangka = $this->request->getPost('nomor_rangka');
                $nama_pemilik = $this->request->getPost('nama_pemilik');
                $alamat_pemilik = $this->request->getPost('alamat_pemilik');
                $catatan = $this->request->getPost('catatan');

                $surat_pernyataan = $this->request->getPost('surat_pernyataan');
                $surat_permohonan = $this->request->getPost('surat_permohonan');
                $scan_ktp = $this->request->getPost('scan_ktp');
                $scan_stnk = $this->request->getPost('scan_stnk');
                // files
                $scan_kwitansi_sidang = $this->request->getFile('scan_kwitansi_sidang');
                $scan_stuk = $this->request->getFile('scan_stuk');
                $scan_pengantar_sidang = $this->request->getFile('scan_pengantar_sidang');
                $scan_kartu_pengawasan = $this->request->getFile('scan_kartu_pengawasan');

                $scan_kwitansi_sidang_lama = $this->request->getVar('scan_kwitansi_sidang_lama');
                $scan_pengantar_sidang_lama = $this->request->getVar('pengantar_sidang_lama');
                $scan_stuk_lama = $this->request->getVar('scan_stuk_lama');
                $scan_kartu_pengawasan_lama = $this->request->getVar('scan_kartu_pengawasan_lama');

                if ($scan_kwitansi_sidang->getError() == 4) {
                    $namaKwitansi = $scan_kwitansi_sidang_lama;
                } else {
                    $fileKwitansiSidangLama = 'admTilang/' . $scan_kwitansi_sidang_lama;
                    if (file_exists($fileKwitansiSidangLama)) {
                        unlink('admTilang/' . $scan_kwitansi_sidang_lama);
                    }
                    $namaKwitansi = $scan_kwitansi_sidang->getRandomName();
                    $scan_kwitansi_sidang->move('admTilang/', $namaKwitansi);
                }


                if ($scan_stuk->getError() == 4) {
                    $namaStuk = $scan_stuk_lama;
                } else {
                    if ($scan_stuk_lama != null) {
                        $fileStukLama = 'admTilang/' . $scan_stuk_lama;
                        if (file_exists($fileStukLama)) {
                            unlink('admTilang/' . $scan_stuk_lama);
                        }
                    }

                    $namaStuk = $scan_stuk->getRandomName();
                    $scan_stuk->move('admTilang/', $namaStuk);
                }

                if ($scan_pengantar_sidang->getError() == 4) {
                    $namaPengantar = $scan_pengantar_sidang_lama;
                } else {
                    if ($scan_pengantar_sidang_lama != null) {
                        $filePengantarSidangLama = 'admTilang/' . $scan_pengantar_sidang_lama;
                        if (file_exists($filePengantarSidangLama)) {
                            unlink('admTilang/' . $scan_pengantar_sidang_lama);
                        }
                    }

                    $namaPengantar = $scan_pengantar_sidang->getRandomName();
                    $scan_pengantar_sidang->move('admTilang/', $namaPengantar);
                }

                if ($scan_kartu_pengawasan->getError() == 4) {
                    $namaKps = $scan_kartu_pengawasan_lama;
                } else {
                    if ($scan_kartu_pengawasan_lama != null) {
                        $fileKartuPengawasanLama = 'admTilang/' . $scan_kartu_pengawasan_lama;
                        if (file_exists($fileKartuPengawasanLama)) {
                            unlink('admTilang/' . $scan_kartu_pengawasan_lama);
                        }
                    }

                    $namaKps = $scan_kartu_pengawasan->getRandomName();
                    $scan_kartu_pengawasan->move('admTilang/', $namaKps);
                }

                $this->suratPengeluaranModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => ucwords($ukpd_id),
                    'noBap' => ucwords($noBap),
                    'type_kendaraan_id' => ucwords($type_kendaraan_id),
                    'nopol' => strtoupper($nopol),
                    'jenis_pelanggaran' => ucwords($jenis_pelanggaran),
                    'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                    'tanggal_pelanggaran' => $tanggal_pelanggaran,
                    'pool_id' => ucwords($pool_id),
                    'tahun_perakitan' => ucwords($tahun_perakitan),
                    'nomor_rangka' => strtoupper($nomor_rangka),
                    'nama_pemilik' => ucwords($nama_pemilik),
                    'alamat_pemilik' => ucwords($alamat_pemilik),
                    'catatan' => ucwords($catatan),
                    'tanggal_pengeluaran' => date('Y-m-d'),
                    'status_surat_id' => 1,
                    'scan_kwitansi_sidang' => $namaKwitansi,
                    'scan_pengantar_sidang' => $namaPengantar,
                    'scan_stuk' => $namaStuk,
                    'scan_kartu_pengawasan' => $namaKps,
                    'surat_permohonan' => $surat_permohonan,
                    'surat_pernyataan' => $surat_pernyataan,
                    'scan_ktp' => $scan_ktp,
                    'scan_stnk' => $scan_stnk,
                ]);

                $messeage = [
                    'success' => 'Surat Pengeluaran Berhasil diUbah',
                    'icon' => 'success',
                    'url' => '/operator/suratPengeluaran'
                ];
            }
            return json_encode($messeage);
        }
    }
}
