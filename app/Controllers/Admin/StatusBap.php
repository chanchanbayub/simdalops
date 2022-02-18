<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StatusBapModel;

class StatusBap extends BaseController
{
    protected $statusBapModel;
    protected $validation;

    public function __construct()
    {
        $this->statusBapModel = new StatusBapModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'E-tilang | Status Berita Acara',
            'statusBap' =>  $this->statusBapModel->orderBy('id desc')->findAll()
        ];

        return view('admin/status_bap', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'status_bap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong!'
                    ],
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'status_bap' => $this->validation->getError('status_bap'),
                    ],
                ];
            } else {
                $status = $this->request->getPost('status_bap');

                $this->statusBapModel->save([
                    'status_bap' => ucwords($status)
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

            $data = $this->statusBapModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $status = $this->request->getPost('status_bap');

            $this->statusBapModel->update($id, [
                'id' => $id,
                'status_bap' => ucwords($status)
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

            $this->statusBapModel->delete($id);

            $messeage = [
                'success' => 'Status Surat Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
