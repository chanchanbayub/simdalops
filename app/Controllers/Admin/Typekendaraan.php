<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KendaraanModel;
use App\Models\Admin\TypeKendaraanModel;

class Typekendaraan extends BaseController
{
    protected $typeKendaraanModel;
    protected $kendaraanModel;

    public function __construct()
    {
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar("page_type_kendaraan") ? $this->request->getVar('page_type_kendaraan') : 1;
        $type_kendaraan = $this->typeKendaraanModel->getAllTypeKendaraan();

        $data = [
            'title' => 'E-Tilang | Type Kendaraan',
            'kendaraan' => $type_kendaraan["type"]->paginate(5, "type_kendaraan"),
            'pager' => $type_kendaraan["type"]->pager,
            'k_kendaraan' => $this->kendaraanModel->findAll(),
            'currentPage' => $currentPage
        ];
        return view('admin/t_kendaraan', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'klasifikasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Tidak Boleh Kosong!'
                    ]
                ],
                'type_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'klasifikasi_id' => $validation->getError('klasifikasi_id'),
                        'type_kendaraan' => $validation->getError('type_kendaraan'),
                    ]
                ];
            } else {
                $klasifikasi_id = $this->request->getPost('klasifikasi_id');
                $type_kendaraan = $this->request->getPost('type_kendaraan');

                $this->typeKendaraanModel->save([
                    'klasifikasi_id' => $klasifikasi_id,
                    'type_kendaraan' => ucwords($type_kendaraan)
                ]);
                $messeage = [
                    'success' => 'Data Type Kendaraan Berhasil di Simpan!',

                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->typeKendaraanModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost("id");
            $klasifikasi_id = $this->request->getPost("klasifikasi_id");
            $type_kendaraan = $this->request->getPost("type_kendaraan");

            $this->typeKendaraanModel->update($id, [
                'id_kendaraan' => $id,
                'klasifikasi_id' => ucwords($klasifikasi_id),
                'type_kendaraan' => ucwords($type_kendaraan)
            ]);

            $messeage = [
                'success' => 'Data Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->typeKendaraanModel->where(["id" => $id])->first();

            $this->typeKendaraanModel->delete($data["id"]);

            $messeage = [
                'success' => 'Data Type Kendaraan Berhasil dihapus!'
            ];

            return json_encode($messeage);
        }
    }
}
