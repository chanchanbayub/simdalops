<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisBapModel;
use App\Models\Admin\UkpdModel;

class JenisBap extends BaseController
{

    protected $ukpdModel;
    protected $jenisBapModel;
    protected $validation;

    public function __construct()
    {
        $this->jenisBapModel = new JenisBapModel();
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis BAP Penindakan',
            'ukpd' => $this->ukpdModel->findAll(),
            'jenis_bap' => $this->jenisBapModel->getJenisBAP()
        ];

        return view('admin/jenis_bap', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong!'
                    ]
                ],
                'jenis_bap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis BAP Tidak Boleh Kosong!'
                    ]
                ],

            ])) {

                $messeage = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'jenis_bap' => $this->validation->getError('jenis_bap'),
                    ]
                ];
            } else {
                $ukpd_id = $this->request->getVar('ukpd_id');
                $jenis_bap = $this->request->getVar('jenis_bap');

                $this->jenisBapModel->save([
                    'ukpd_id' => $ukpd_id,
                    'jenis_bap' => ucwords($jenis_bap)
                ]);

                $messeage = [
                    'success' => 'Data Jenis BAP Berhasil diTambahkan!'
                ];
            }

            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $jenis_bap = $this->jenisBapModel->where(["jenis_bap.id" => $id])->first();

            return json_encode($jenis_bap);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVAR('id');
            $ukpd_id = $this->request->getVAR('ukpd_id');
            $jenis_bap = $this->request->getVAR('jenis_bap');

            $this->jenisBapModel->update($id, [
                'id' => $id,
                'ukpd_id' => $ukpd_id,
                'jenis_bap' => ucwords($jenis_bap)
            ]);

            $messeage = [
                'success' => 'Jenis BAP Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->jenisBapModel->delete($id);

            $messeage = [
                'success' => 'Jenis BAP Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
