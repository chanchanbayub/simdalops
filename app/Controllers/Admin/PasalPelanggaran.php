<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PasalPelanggaranModel;

class PasalPelanggaran extends BaseController
{

    protected $validation;
    protected $pasalPelanggaranModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->pasalPelanggaranModel = new PasalPelanggaranModel();
    }

    public function index()
    {

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pasal = $this->pasalPelanggaranModel->search($keyword);
        } else {
            $pasal = $this->pasalPelanggaranModel->getPasal();
        }



        $currentPage = $this->request->getVar('page_pasal_pelanggaran') ? $this->request->getVar('page_pasal_pelanggaran') : 1;

        $data = [
            'title' => 'Data Pasal Pelanggaran',
            'pasal' => $pasal["pasal_pelanggaran"]->paginate(10, 'pasal_pelanggaran'),
            'pager' => $pasal["pasal_pelanggaran"]->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/pasal_pelanggaran', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'pasal_pelanggaran' => [
                    'rules' => 'required|numeric|matches[pasal_pelanggaran]',
                    'errors' => [
                        'required' => 'Pasal Tidak Boleh Kosong!',
                        'numeric' => 'Yang anda masukan bukan Angka!',
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong!',
                    ]
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'pasal_pelanggaran' => $this->validation->getError('pasal_pelanggaran'),
                        'keterangan' => $this->validation->getError('keterangan')
                    ],
                ];
            } else {
                $pasal_pelanggaran = $this->request->getVar('pasal_pelanggaran');
                $keterangan = $this->request->getVar('keterangan');

                $this->pasalPelanggaranModel->save([
                    'pasal_pelanggaran' => $pasal_pelanggaran,
                    'keterangan' => ucwords($keterangan)
                ]);

                $messeage = [
                    'success' => 'Pasal Pelanggaran Berhasil di tambahakan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pasal_pelanggaran = $this->pasalPelanggaranModel->where(["id" => $id])->first();

            return json_encode($pasal_pelanggaran);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pasal_pelanggaran = $this->request->getVar('pasal_pelanggaran');
            $keterangan = $this->request->getVar('keterangan');

            $this->pasalPelanggaranModel->update($id, [
                'id' => $id,
                'pasal_pelanggaran' => $pasal_pelanggaran,
                'keterangan' => ucwords($keterangan)
            ]);
            $messeage = [
                'success' => 'Pasal Pelanggaran Berhasil di Ubah!'
            ];
            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->pasalPelanggaranModel->delete($id);

            $messeage = [
                'success' => 'Pasal Pelanggaran Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        }
    }
}
