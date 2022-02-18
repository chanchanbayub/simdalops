<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PenindakanModel;

class Penindakan extends BaseController
{
    protected $penindakanModel;

    public function __construct()
    {
        $this->penindakanModel = new PenindakanModel();
    }

    public function index()
    {
        $data = [
            'penindakan' => $this->penindakanModel->orderBy("id desc")->findAll(),
            'title' => 'E-Tilang | Jenis Penindakan'
        ];
        return view("admin/penindakan", $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'nama_penindakan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Penindakan Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'nama_penindakan' => $validation->getError('nama_penindakan')
                    ]
                ];
            } else {
                $nama_penindakan = $this->request->getVar('nama_penindakan');

                $this->penindakanModel->save([
                    'nama_penindakan' => ucwords($nama_penindakan)
                ]);

                $messeage = [
                    'success' => 'Data Penindakan Berhasil disimpan!'
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

            $data = $this->penindakanModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $nama_penindakan = $this->request->getPost('nama_penindakan');

            $this->penindakanModel->update($id, [
                'id' => $id,
                'nama_penindakan' => ucwords($nama_penindakan)
            ]);

            $messeage = [
                'success' => 'Data Penindakan Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = $this->penindakanModel->where(["id" => $id])->first();

            $this->penindakanModel->delete($data["id"]);

            $messeage = [
                'success' => 'Data Penindakan Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
