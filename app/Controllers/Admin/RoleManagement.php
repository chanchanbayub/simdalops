<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\RoleManagementModel;

class RoleManagement extends BaseController
{
    protected $roleManagementModel;

    public function __construct()
    {
        $this->roleManagementModel = new RoleManagementModel();
    }

    public function index()
    {
        $data = [
            'title' => 'E-Tilang | Role Management',
            'role' => $this->roleManagementModel->orderBy('id desc')->findAll()
        ];

        return view('admin/role_management', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'role_management' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Role Tidak Boleh Kosong!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'role_management' => $validation->getError('role_management')
                    ]
                ];
            } else {
                $role = $this->request->getPost('role_management');

                $this->roleManagementModel->save([
                    'role_management' => ucwords($role)
                ]);

                $messeage = [
                    'success' => 'Role Management Baru Berhasil diSimpan!'
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

            $data = $this->roleManagementModel->where(["id" => $id])->first();

            return json_encode($data);
        } else {
            return redirect()->back();
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $role_management = $this->request->getPost('role_management');

            $this->roleManagementModel->update($id, [
                'id' => $id,
                'role_management' => ucwords($role_management)
            ]);

            $messeage = [
                'success' => 'Role Management Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        } else {
            return redirect()->back();
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->roleManagementModel->where(["id" => $id])->first();

            $this->roleManagementModel->delete($data["id"]);

            $messeage = [
                'success' => 'Role Management Berhasil di Hapus!'
            ];

            return json_encode($messeage);
        } else {
            return redirect()->back();
        }
    }
}
