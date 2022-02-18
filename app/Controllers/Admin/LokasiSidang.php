<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\LokasiSidangModel;
use App\Models\Admin\UkpdModel;

class LokasiSidang extends BaseController
{
    protected $ukpdModel;
    protected $validation;
    protected $lokasiSidangModel;

    public function __construct()
    {
        $this->ukpdModel = new  UkpdModel();
        $this->validation = \Config\Services::validation();
        $this->lokasiSidangModel = new LokasiSidangModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_lokasi_sidang') ? $this->request->getVar('page_lokasi_sidang') : 1;
        $lokasi_sidang = $this->lokasiSidangModel->getLokasiSidang();

        $data = [
            'title' => 'Lokasi Sidang',
            'ukpd' => $this->ukpdModel->findAll(),
            'lokasi_sidang' => $lokasi_sidang["lokasi_sidang"]->paginate(5, 'lokasi_sidang'),
            'pager' => $lokasi_sidang["lokasi_sidang"]->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/lokasi_sidang', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>   'UKPD Tidak Boleh Kosong!'
                    ],
                ],
                'lokasi_sidang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Sidang Tidak Boleh Kosong'
                    ]
                ]

            ])) {
                $messeage = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'lokasi_sidang' => $this->validation->getError('lokasi_sidang'),
                    ],
                ];
            } else {
                $ukpd_id = $this->request->getVar('ukpd_id');
                $lokasi_sidang = $this->request->getVar('lokasi_sidang');

                $this->lokasiSidangModel->save([
                    'ukpd_id' => $ukpd_id,
                    'lokasi_sidang' => ucwords($lokasi_sidang)
                ]);

                $messeage = [
                    'success' => 'Lokasi Sidang Berhasil ditambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $lokasi_sidang = $this->lokasiSidangModel->where(["id" => $id])->first();

            return json_encode($lokasi_sidang);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $ukpd_id = $this->request->getVar('ukpd_id');
            $lokasi_sidang = $this->request->getVar('lokasi_sidang');

            $this->lokasiSidangModel->update($id, [
                'id' => $id,
                'ukpd_id' => $ukpd_id,
                'lokasi_sidang' => $lokasi_sidang
            ]);

            $messeage = [
                'success' => 'Lokasi Sidang Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->getVar()) {
            $id = $this->request->getVar('id');

            $this->lokasiSidangModel->delete($id);

            $messeage = [
                'success' => 'Lokasi Sidang Berhasil Dihapus!'
            ];

            return json_encode($messeage);
        }
    }
}
