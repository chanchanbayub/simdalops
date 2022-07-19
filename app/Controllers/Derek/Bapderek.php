<?php

namespace App\Controllers\Derek;

use App\Controllers\BaseController;
use App\Database\Migrations\Bap;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\Kecamatan;
use App\Models\Admin\KelurahanModel;
use App\Models\Admin\KendaraanModel;
use App\Models\Admin\Kota;
use App\Models\Admin\LokasiPenindakanModel;
use App\Models\Admin\PenindakanModel;
use App\Models\Admin\PoolPenyimpananModel;
use App\Models\Admin\Provinsi;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Derek\BapDerekModel;
use App\Models\Derek\PenderekanModel;

class Bapderek extends BaseController
{
    protected $bapDerekModel;
    // protected $bapModel;
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
        // $this->bapModel = new BapDerekModel();
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
        $this->lokasiPenindakanModel = new LokasiPenindakanModel();
        $this->penderekanModel = new PenderekanModel();
    }

    public function index()
    {
        $bapDerek = $this->bapDerekModel->getBapDerek();
        // dd($bapDerek);

        $data = [
            'title' => 'BAP Derek',
            'bapDerek' => $bapDerek
        ];

        return view('derek/bap', $data);
    }

    public function tambah_penderekan($noBap)
    {
        $bap = $this->bapDerekModel->where(["noBap" => $noBap])->first();
        $jenis_penindakan = $this->penindakanModel->where(['id' => 4])->first();
        // dd($bap);

        $data = [
            'title' => 'Tambah Penindakan',
            'noBap' => $bap,
            'jenis_penindakan' => $jenis_penindakan,
            'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->findAll(),
            'jenis_kendaraan' => $this->JenisKendaraanModel->findAll(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kota' => $this->kotaModel->findAll(),
            'kecamatan' => $this->kecamatanModel->findAll(),
        ];

        if ($bap == null) {
            return redirect()->back();
        } else {
            return view('derek/tambah_penderekan', $data);
        }
    }

    public function getPool()
    {
        if ($this->request->isAJAX()) {

            $penindakan_id = $this->request->getPost('penindakan_id');

            $pool = $this->poolPenyimpananModel->where(["penindakan_id" => $penindakan_id])->findAll();

            return json_encode($pool);
        }
    }

    public function getKlasifikasiKendaraan()
    {
        if ($this->request->isAJAX()) {
            $jenis_kendaraan_id = $this->request->getVar('jenis_kendaraan_id');

            $klasifikasi_kendaraan = $this->klasifikasiKendaraanModel->where(["jenis_kendaraan_id" => $jenis_kendaraan_id])->findAll();

            return json_encode($klasifikasi_kendaraan);
        }
    }

    public function getTypeKendaraan()
    {
        if ($this->request->isAJAX()) {

            $klasifikasi_id = $this->request->getVar('klasifikasi_id');

            $typeKendaraan = $this->typeKendaraanModel->where(["klasifikasi_id" => $klasifikasi_id])->findAll();

            return json_encode($typeKendaraan);
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

                'lokasi_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Pelanggaran Tidak Boleh Kosong'
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
                $warna_kendaraan = $this->request->getVar('warna_kendaraan');
                $lokasi_pelanggaran = $this->request->getVar('lokasi_pelanggaran');
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



                $this->penderekanModel->save([
                    'ukpd_id' => $ukpd_id,
                    'penindakan_id' => $penindakan_id,
                    'jenis_kendaraan_id' => $jenis_kendaraan_id,
                    'klasifikasi_id' => $klasifikasi_id,
                    'kendaraan_id' => $kendaraan_id,
                    'bap_id' => $bap_id,
                    'nopol' => strtoupper($nopol),
                    'provinsi_id' => $provinsi_id,
                    'kota_id' => $kota_id,
                    'kecamatan_id' => $kecamatan_id,
                    'kelurahan_id' => $kelurahan_id,
                    'keterangan' => $keterangan,
                    'pool_id' => $pool_id,
                    'tanggal_penindakan' => date('Y-m-d'),
                    'jam_penindakan' => date('H:i:s'),
                    'lokasi_pelanggaran' => ucwords($lokasi_pelanggaran),
                    'tanggal_masuk_bap' => date('Y-m-d'),
                    'warna_kendaraan' => $warna_kendaraan,
                    'nama_pelanggar' => ucwords($nama_pelanggar),
                    'alamat_pelanggar' => ucwords($alamat_pelanggar),
                    'foto' => $namaFoto
                ]);

                $this->bapDerekModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => 2
                ]);

                $messeage = [
                    'success' => 'Laporan Penindakan Berhasil ditambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }
}
