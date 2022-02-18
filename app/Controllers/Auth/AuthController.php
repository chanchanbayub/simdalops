<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\PoolPenyimpananModel;
use App\Models\Admin\RoleManagementModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UnitPenindakModel;
use App\Models\Admin\UsersManagementModel;
use App\Models\Auth\AuthModel;

class AuthController extends BaseController
{
    protected $authModel;
    protected $ukpdModel;
    protected $roleManagementModel;
    protected $usersManagemenetModel;
    protected $unitPenindakModel;
    protected $poolPenyimpananModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->ukpdModel = new UkpdModel();
        $this->roleManagementModel = new RoleManagementModel();
        $this->usersManagemenetModel = new UsersManagementModel();
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->poolPenyimpananModel = new PoolPenyimpananModel();
    }

    public function index()
    {
        session();
        session_destroy();
        // dd(session('role_management'));
        $data = [
            'title' => 'Simdalops Dinas Perhubungan | Login'
        ];
        return view("auth/login", $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Simdalops Dinas Perhubungan | Register',
            'ukpd' => $this->ukpdModel->findAll(),
            'role' => $this->roleManagementModel->findAll()
        ];
        return view("auth/register", $data);
    }

    public function getUkpd()
    {
        if ($this->request->isAJAX()) {
            $ukpd_id = $this->request->getVar('ukpd_id');

            $data = $this->ukpdModel->where(["id" => $ukpd_id])->first();

            return json_encode($data);
        }
    }

    public function registerProgres()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong!'
                    ]
                ],
                'role_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Tidak Boleh Kosong!'
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[usersManagement.username]',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong!',
                        'is_unique' => 'Username Sudah Terdaftar!'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong!',
                        'min_length' => 'Password Minimal 8 Karakter!'
                    ]
                ],
                'confirmPassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi Password Tidak Boleh Kosong!',
                        'matches' => 'Konfirmasi Password Salah!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'ukpd_id' => $validation->getError('ukpd_id'),
                        'role_id' => $validation->getError('role_id'),
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'confirmPassword' => $validation->getError('confirmPassword'),
                    ]
                ];
            } else {
                $ukpd_id = $this->request->getPost('ukpd_id');
                $role_id = $this->request->getPost('role_id');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $confirmPassword = $this->request->getPost('confirmPassword');

                $this->usersManagemenetModel->save([
                    'ukpd_id' => $ukpd_id,
                    'role_id' => $role_id,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'status'   => 0
                ]);

                $messeage = [
                    'success' => 'Berhasil Mendaftar!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function getLogin()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>  'Username Tidak Boleh Kosong!',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong!'
                    ]
                ],
                'confirmPassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi Password Tidak Boleh Kosong!',
                        'matches' => 'Konfirmasi Password Salah!'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'confirmPassword' => $validation->getError('confirmPassword')
                    ]
                ];
            } else {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $confirmPassword = $this->request->getPost('confirmPassword');

                $data = $this->authModel->getDataUsers($username);
                // $userData = [];                // return json_encode($data);

                if ($data > 0) {
                    if (password_verify($password, $data["password"])) {
                        if ($data["status"] == 0) {
                            $messeage = [
                                'errors' => 'Silahkan Hubungi Admin Untuk Mengaktifkan Akun Anda!',
                                'icon'  => 'warning'
                            ];
                        } else if ($data["status"] == 1) {

                            $userData = [
                                'isLoggedIn' => true,
                                'id' => $data["id"],
                                'username' => $data["username"],
                                'password' => $data["password"],
                                'nama_dinas' => $data["nama_dinas"],
                                'status' => $data["status"],
                                'ukpd' => $data["ukpd"],
                                'ukpd_id' => $data["ukpd_id"],
                                'role_management' => $data["role_management"],
                                'role_id' => $data["role_id"],
                            ];
                            session()->set($userData);
                            if ($data["role_management"] == "Sudinhub") {
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'sudinhub/dashboard'
                                ];
                            } else if ($data["role_management"] == "Admin") {
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'admin/dashboard'
                                ];
                            } else if ($data["role_management"] == "Operator") {
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'operator/dashboard'
                                ];
                            } else if ($data["role_management"] == "Verifikator") {
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'verifikator/dashboard'
                                ];
                            } else if ($data["role_management"] == "Kepala Seksi") {
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'kasie/dashboard'
                                ];
                            } else if ($data["role_management"] == "Kepala Bidang") {
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'kabid/dashboard'
                                ];
                            } else if ($data["role_management"] == "Petugas") {
                                $dataUnit = $this->unitPenindakModel->where(["unit_penindak" => $data["username"]])->first();
                                // return json_encode($dataUnit);
                                $userData = [
                                    'isLoggedIn' => true,
                                    'id' => $data["id"],
                                    'username' => $data["username"],
                                    'password' => $data["password"],
                                    'nama_dinas' => $data["nama_dinas"],
                                    'status' => $data["status"],
                                    'ukpd' => $data["ukpd"],
                                    'ukpd_id' => $data["ukpd_id"],
                                    'role_management' => $data["role_management"],
                                    'role_id' => $data["role_id"],
                                    'unit_id' => $dataUnit['id'],
                                    'unit_penindak' => $dataUnit['unit_penindak']
                                ];
                                session()->set($userData);
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'petugas/dashboard'
                                ];
                            } else if ($data["role_management"] == "Pengandangan") {
                                $poolPenyimpanan = $this->poolPenyimpananModel->where(["nama_terminal" => $data["username"]])->first();
                                $userData = [
                                    'isLoggedIn' => true,
                                    'id' => $data["id"],
                                    'username' => $data["username"],
                                    'password' => $data["password"],
                                    'nama_dinas' => $data["nama_dinas"],
                                    'status' => $data["status"],
                                    'ukpd' => $data["ukpd"],
                                    'ukpd_id' => $data["ukpd_id"],
                                    'role_management' => $data["role_management"],
                                    'role_id' => $data["role_id"],
                                    'pool_id' => $poolPenyimpanan['id'],
                                    'nama_terminal' => $poolPenyimpanan['nama_terminal']
                                ];
                                session()->set($userData);
                                $messeage = [
                                    'success' => 'Sukses, Anda Berhasil Login!',
                                    'icon' => 'success',
                                    'url' => 'pengandangan/dashboard'
                                ];
                            }
                        }
                    } else {
                        $messeage = [
                            'errors' => 'Username atau Password Salah!',
                            'icon' => 'question'
                        ];
                    }
                } else {
                    $messeage = [
                        'errors' => 'Username Tidak ditemukan!',
                        'icon' => 'error'
                    ];
                }
            }
        }
        return json_encode($messeage);
    }

    public function logout()
    {
        session_destroy();
        session_unset();

        return redirect()->to(base_url('/'));
    }
}
