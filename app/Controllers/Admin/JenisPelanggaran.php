<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisPelanggaranModel;
use App\Models\Admin\PasalPelanggaranModel;

class JenisPelanggaran extends BaseController
{

    protected $pasalPelanggaranModel;
    protected $jenisPelanggaranModel;
    protected $validation;

    public function __construct()
    {
        $this->pasalPelanggaranModel = new PasalPelanggaranModel();
        $this->validation = \Config\Services::validation();
        $this->jenisPelanggaranModel = new JenisPelanggaranModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        // dd($keyword);

        if ($keyword) {
            $jenis_pelanggaran = $this->jenisPelanggaranModel->search($keyword);
        } else {
            $jenis_pelanggaran = $this->jenisPelanggaranModel->getJenisPelanggaran();
        }

        $currentPage = $this->request->getVar('page_jenis_pelanggaran') ? $this->request->getVar('page_jenis_pelanggaran') : 1;

        $data = [
            'title' => 'Jenis Pelanggaran',
            'pasal_pelanggaran' => $this->pasalPelanggaranModel->findAll(),
            'jenis_pelanggaran' => $jenis_pelanggaran["jenis_pelanggaran"]->paginate(10, 'jenis_pelanggaran'),
            'pager' => $jenis_pelanggaran["jenis_pelanggaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/jenis_pelanggaran', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'pasal_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pasal Pelanggaran Tidak Boleh Kosong!',
                    ]
                ],
                'jenis_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pelanggaran Tidak Boleh Kosong!',
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'pasal_id' => $this->validation->getError('pasal_id'),
                        'jenis_pelanggaran' => $this->validation->getError('jenis_pelanggaran'),
                    ]
                ];
            } else {

                $pasal_id = $this->request->getVar('pasal_id');
                $jenis_pelanggaran = $this->request->getVar('jenis_pelanggaran');

                $this->jenisPelanggaranModel->save([
                    'pasal_id' => $pasal_id,
                    'jenis_pelanggaran' => ucwords($jenis_pelanggaran)
                ]);

                $messeage = [
                    'success' => 'Data Berhasil di Tambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $jenis_pelanggaran = $this->jenisPelanggaranModel->where(["id" => $id])->first();

            return json_encode($jenis_pelanggaran);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $pasal_id = $this->request->getVar('pasal_id');
            $jenis_pelanggaran = $this->request->getVar('jenis_pelanggaran');

            $this->jenisPelanggaranModel->update($id, [
                'id' => $id,
                'pasal_id' => $pasal_id,
                'jenis_pelanggaran' => ucwords($jenis_pelanggaran)
            ]);

            $messeage = [
                'success' => 'Jenis Pelanggaran Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->jenisPelanggaranModel->delete($id);

            $messeage = [
                'success' => 'Jenis Pelanggaran Berhasil di Hapus'
            ];

            return json_encode($messeage);
        }
    }
}
