<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StatusSuratModel;

class StatusSurat extends BaseController
{
    protected $statusSuratModel;
    protected $validation;
    public function __construct()
    {
        $this->statusSuratModel = new StatusSuratModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'E-tilang | Status Surat',
            'status' =>  $this->statusSuratModel->orderBy('id desc')->findAll()
        ];

        return view('admin/status_surat', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong!'
                    ],
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'name' => $this->validation->getError('name'),
                    ],
                ];
            } else {
                $status = $this->request->getPost('name');

                $this->statusSuratModel->save([
                    'name' => ucwords($status)
                ]);

                $messeage = [
                    'success' => 'Status Surat Berhasil Ditambah!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->statusSuratModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $status = $this->request->getPost('name');

            $this->statusSuratModel->update($id, [
                'id' => $id,
                'name' => ucwords($status)
            ]);

            $messeage = [
                'success' => 'Status Surat Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->statusSuratModel->delete($id);

            $messeage = [
                'success' => 'Status Surat Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
