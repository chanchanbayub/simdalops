<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KendaraanModel;


class Kendaraan extends BaseController
{
    protected $KendaraanModel;
    protected $penindakanModel;

    public function __construct()
    {
        $this->KendaraanModel = new KendaraanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar("page_klasifikasi_kendaraan") ? $this->request->getVar("page_klasifikasi_kendaraan") : 1;
        $kendaraan = $this->KendaraanModel->getKlasifikasiKendaraan();
        $data = [
            'title' => 'E-Tilang | Klasifikasi Kendaraan',
            'kendaraan' => $kendaraan["klasifikasi_kendaraan"]->orderBy('id desc')->paginate(5, "klasifikasi_kendaraan"),
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
                'nama_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'nama_kendaraan' => $validation->getError('nama_kendaraan')
                    ]
                ];
            } else {
                $nama_kendaraan = $this->request->getPost('nama_kendaraan');

                $this->KendaraanModel->save([
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
            $nama_kendaraan = $this->request->getPost('nama_kendaraan');

            $this->KendaraanModel->update($id, [
                'id' => $id,
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
