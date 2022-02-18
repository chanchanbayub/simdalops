<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PenindakanModel;
use App\Models\Admin\PoolPenyimpananModel;

class PoolPenyimpanan extends BaseController
{
    protected $poolPenyimpananModel;
    protected $penindakanModel;

    public function __construct()
    {
        $this->poolPenyimpananModel = new PoolPenyimpananModel();
        $this->penindakanModel = new PenindakanModel();
    }

    public function index()
    {
        $poolPenyimpanan = $this->poolPenyimpananModel->getPoolPenyimpanan();
        $currentPage = $this->request->getVar("page_poolpenyimpanan") ? $this->request->getVar('page_poolpenyimpanan') : 1;
        $data = [
            'title' => 'E-Tilang | Pool Penyimpanan',
            'penyimpanan' => $poolPenyimpanan["pool_penyimpanan"]->paginate(5, "poolpenyimpanan"),
            'pager' => $poolPenyimpanan["pool_penyimpanan"]->pager,
            'penindakan' => $this->penindakanModel->findAll(),
            'currentPage' => $currentPage
        ];

        return view('admin/p_penyimpanan', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'penindakan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Penindakan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_terminal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Terminal Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $messeage = [
                    'error' => [
                        'nama_terminal' => $validation->getError('nama_terminal'),
                        'penindakan_id' => $validation->getError('penindakan_id'),
                    ]
                ];
            } else {
                $penindakan_id = $this->request->getPost('penindakan_id');
                $nama_terminal = $this->request->getPost('nama_terminal');

                $this->poolPenyimpananModel->save([
                    'penindakan_id' => ucwords($penindakan_id),
                    'nama_terminal' => ucwords($nama_terminal)
                ]);

                $messeage = [
                    'success' => 'Pool Penyimpanan Berhasil di Simpan!'
                ];
            }

            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->poolPenyimpananModel->where(['id' => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $penindakan_id = $this->request->getPost('penindakan_id');
            $nama_terminal = $this->request->getPost('nama_terminal');

            $this->poolPenyimpananModel->update($id, [
                'id' => ucwords($id),
                'penindakan_id' => ucwords($penindakan_id),
                'nama_terminal' => ucwords($nama_terminal)
            ]);

            $messeage = [
                'success' => 'Pool Penyimpanan Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->poolPenyimpananModel->where(["id" => $id])->first();

            $this->poolPenyimpananModel->delete($data["id"]);

            $messeage = [
                'success' => 'Pool Penyimmpanan Berhasil di Hapus!'
            ];
            return json_encode($messeage);
        }
    }
}
