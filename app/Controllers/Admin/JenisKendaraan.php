<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;

class JenisKendaraan extends BaseController
{
    protected $jenisKendaraanModel;

    public function __construct()
    {
        $this->jenisKendaraanModel = new JenisKendaraanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Simdalops | Jenis Kendaraan',
            'jenis_kendaraan' => $this->jenisKendaraanModel->findAll()
        ];
        return view('admin/jenis_kendaraan', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'jenis_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'jenis_kendaraan' => $validation->getError('jenis_kendaraan')
                    ]
                ];
            } else {
                $jenis_kendaraan = $this->request->getPost('jenis_kendaraan');

                $this->jenisKendaraanModel->save([
                    'jenis_kendaraan' => ucwords($jenis_kendaraan)
                ]);

                $messeage = [
                    'success' => 'Jenis Kendaraan Berhasil di Tambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->jenisKendaraanModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $jenis_kendaraan = $this->request->getPost('jenis_kendaraan');

            $this->jenisKendaraanModel->update($id, [
                'id' => $id,
                'jenis_kendaraan' => ucwords($jenis_kendaraan)
            ]);

            $messeage = [
                'success' => 'Jenis Kendaraan Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->jenisKendaraanModel->where(["id" => $id])->first();

            $this->jenisKendaraanModel->delete($data["id"]);

            $messeage = [
                'success' => 'Data Jenis Kendaraan Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
