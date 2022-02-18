<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\RoleManagementModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UsersManagementModel;

class UsersManagement extends BaseController
{
    protected $usersManagementModel;
    protected $ukpdModel;
    protected $roleManagementModel;

    public function __construct()
    {
        $this->usersManagementModel = new UsersManagementModel();
        $this->ukpdModel = new UkpdModel();
        $this->roleManagementModel = new RoleManagementModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_usersManagement') ? $this->request->getVar('page_usersManagement') : 1;

        $usersManagement = $this->usersManagementModel->getAllUsersManagement();

        $data = [
            'title' => 'E-Tilang | Users Management',
            'usersManagement' => $usersManagement["users"]->paginate(10, 'usersManagement'),
            'pager' => $usersManagement["users"]->pager,
            'currentPage' => $currentPage,
            'ukpd' => $this->ukpdModel->findAll(),
            'role' => $this->roleManagementModel->findAll()
        ];

        return view('admin/usersManagement', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong!',
                    ]
                ],
                'role_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Tidak Boleh Kosong!'
                    ]
                ],
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong!'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong!'
                    ]
                ]

            ])) {
                $messeage = [
                    'error' => [
                        'ukpd_id' => $validation->getError('ukpd_id'),
                        'role_id' => $validation->getError('role_id'),
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $role_id = $this->request->getPost('role_id');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $noHp = $this->request->getPost('noHp');

                $this->usersManagementModel->save([
                    'ukpd_id' => $ukpd_id,
                    'role_id' => $role_id,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'noHp' => $noHp,
                    'status' => 0
                ]);

                $messeage = [
                    'success' => 'Data Users Berhasil di Tambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = $this->usersManagementModel->where(["id" => $id])->first();

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $ukpd_id = $this->request->getPost('ukpd_id');
            $role_id = $this->request->getPost('role_id');
            $username = $this->request->getPost('username');
            $noHp = $this->request->getPost('noHp');
            $password = password_hash($this->request->getPost('status'), PASSWORD_DEFAULT);

            $this->usersManagementModel->update($id, [
                'id' => $id,
                'ukpd_id' => $ukpd_id,
                'role_id' => $role_id,
                'username' => $username,
                'noHp' => $noHp,
                'password' => $password
            ]);

            $messeage = [
                'success' => 'Data Users Berhasil di Ubah!'
            ];

            return json_encode($messeage);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $user = $this->usersManagementModel->getIdUser($id);

            $this->usersManagementModel->delete($user["id"]);
            if ($user["ttd"] != null) {
                unlink("" . $user["ttd"]);
            }


            $messeage = [
                'success' => 'Data Users Berhasil di Hapus!'
            ];
            return json_encode($messeage);
        }
    }

    public function update_status()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $status_id = $this->request->getVar('status_id');

            $this->usersManagementModel->update($id, [
                'id' => $id,
                'status' => $status_id
            ]);

            $messeage = [
                'success' => "Status Berhasil di Perbaharui!"
            ];

            return json_encode($messeage);
        }
    }
}
