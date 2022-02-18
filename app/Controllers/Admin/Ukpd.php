<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UkpdModel;

class Ukpd extends BaseController
{
    protected $ukpdModel;

    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
    }

    public function index()
    {
        $data = [
            'ukpd' => $this->ukpdModel->orderBy("id desc")->findAll(),
            'title' => 'UKPD | E-tilang'
        ];
        return view("admin/ukpd", $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            if (!$this->validate([
                'ukpd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong!'
                    ],
                ],
                'nama_dinas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Dinas Tidak Boleh Kosong!'
                    ]
                ]

            ])) {
                $messeage = [
                    'error' => [
                        'ukpd' => $validation->getError('ukpd'),
                        'nama_dinas' => $validation->getError('nama_dinas')
                    ],
                ];
            } else {
                $ukpd = $this->request->getVar('ukpd');
                $nama_dinas = $this->request->getPost('nama_dinas');

                $this->ukpdModel->save([
                    'ukpd' => ucwords($ukpd),
                    'nama_dinas' => ucwords($nama_dinas)
                ]);
                $messeage = [
                    'success' => 'Data UKPD Berhasil disimpan!'
                ];
            }
            return json_encode($messeage);
        } else {
            return redirect()->back();
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->ukpdModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $ukpd = $this->request->getPost('ukpd');
            $nama_dinas = $this->request->getPost('nama_dinas');

            $this->ukpdModel->update($id, [
                'id' => ucwords($id),
                'ukpd' => ucwords($ukpd),
                'nama_dinas' => ucwords($nama_dinas)
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
            $id = $this->request->getPost('id');

            $data = $this->ukpdModel->where(["id" => $id])->first();


            $this->ukpdModel->delete($data["id"]);

            $messeage = [
                'success' => 'Data Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
