<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisBapModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UnitPenindakModel;

class UnitPenindak extends BaseController
{
    protected $ukpdModel;
    protected $unitPenindakModel;
    protected $jenisBapModel;
    protected $validation;

    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->jenisBapModel = new JenisBapModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $unit_penindak = $this->unitPenindakModel->getDataUnitPenindak();

        $currentPage = $this->request->getVar('page_unit_penindak') ? $this->request->getVar('page_unit_penindak') : 1;

        $data = [
            'title' => 'E-Tilang | Unit Penidak',
            'ukpd' => $this->ukpdModel->findAll(),
            'unitPenindak' => $unit_penindak["unit_penindak"]->paginate(10, 'unit_penindak'),
            'pager' => $unit_penindak["unit_penindak"]->pager,
            'jenis_bap' => $this->jenisBapModel->findAll(),
            'currentPage' => $currentPage
        ];

        return view('admin/unit', $data);
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
                'unit_penindak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit / Regu Tidak Boleh Kosong!'
                    ]
                ],
                'jenis_bap_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis BAP Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'unit_penindak' => $this->validation->getError('unit_penindak'),
                        'jenis_bap_id' => $this->validation->getError('jenis_bap_id')
                    ]
                ];
            } else {
                $ukpd_id = $this->request->getVar('ukpd_id');
                $unit_penindak = $this->request->getVar('unit_penindak');
                $jenis_bap_id = $this->request->getVar('jenis_bap_id');

                $this->unitPenindakModel->save([
                    'ukpd_id' => $ukpd_id,
                    'unit_penindak' => $unit_penindak,
                    'jenis_bap_id' => $jenis_bap_id
                ]);

                $messeage = [
                    'success' => 'Unit Penindak Berhasil ditambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $unitPenindak = $this->unitPenindakModel->where(["id" => $id])->first();

            return json_encode($unitPenindak);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $ukpd_id = $this->request->getVar('ukpd_id');
            $unit_penindak = $this->request->getVar('unit_penindak');
            $jenis_bap_id = $this->request->getVar('jenis_bap_id');

            $this->unitPenindakModel->update($id, [
                'id' => $id,
                'ukpd_id' => $ukpd_id,
                'unit_penindak' => $unit_penindak,
                'jenis_bap_id' => $jenis_bap_id,
            ]);

            $messeage = [
                'success' => 'Unit Penindak Berhasi di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $unit_penindak = $this->unitPenindakModel->where(["id" => $id])->first();

            $this->unitPenindakModel->delete($unit_penindak["id"]);

            $messeage = [
                'success' => 'Unit Penindak Berhasil dihapus!'
            ];

            return json_encode($messeage);
        }
    }
}
