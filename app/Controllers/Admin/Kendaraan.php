<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\KendaraanModel;


class Kendaraan extends BaseController
{
    protected $KendaraanModel;
    protected $jenisKendaraanModel;

    public function __construct()
    {
        $this->KendaraanModel = new KendaraanModel();
        $this->jenisKendaraanModel = new JenisKendaraanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar("page_klasifikasi_kendaraan") ? $this->request->getVar("page_klasifikasi_kendaraan") : 1;
        $kendaraan = $this->KendaraanModel->getKlasifikasiKendaraan();
        // dd($kendaraan["klasifikasi_kendaraan"]->get()->resultArray());

        // $kendaraanData = $this->KendaraanModel->data();
        // dd($kendaraanData);
        $data = [
            'title' => 'Simdalops | Klasifikasi Kendaraan',
            'kendaraan' => $kendaraan["klasifikasi_kendaraan"]->orderBy('id desc')->paginate(5, "klasifikasi_kendaraan"),
            'jenis_kendaraan' => $this->jenisKendaraanModel->findAll(),
            'pager' => $kendaraan["klasifikasi_kendaraan"]->pager,
            'currentPage' => $currentPage
        ];
        return view('admin/kendaraan', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'jenis_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'jenis_kendaraan_id' => $validation->getError('jenis_kendaraan_id'),
                        'nama_kendaraan' => $validation->getError('nama_kendaraan')
                    ]
                ];
            } else {
                $jenis_kendaraan_id = $this->request->getPost('jenis_kendaraan_id');
                $nama_kendaraan = $this->request->getPost('nama_kendaraan');

                $this->KendaraanModel->save([
                    'jenis_kendaraan_id' => ucwords($jenis_kendaraan_id),
                    'nama_kendaraan' => ucwords($nama_kendaraan)
                ]);

                $messeage = [
                    'success' => 'Klasifikasi Kendaraan Berhasil di Tambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->KendaraanModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $jenis_kendaraan_id = $this->request->getPost('jenis_kendaraan_id');
            $nama_kendaraan = $this->request->getPost('nama_kendaraan');

            $this->KendaraanModel->update($id, [
                'id' => $id,
                'jenis_kendaraan_id' => ucwords($jenis_kendaraan_id),
                'nama_kendaraan' => ucwords($nama_kendaraan)
            ]);

            $messeage = [
                'success' => 'Klasifikasi Kendaraan Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->KendaraanModel->where(["id" => $id])->first();

            $this->KendaraanModel->delete($data["id"]);

            $messeage = [
                'success' => 'Data Klasifikasi Kendaraan Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
