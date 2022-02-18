<?php

namespace App\Controllers\Kabid;

use App\Controllers\BaseController;
use App\Models\Kabid\ProfileModel;

class Profile extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $data = [
            'profile' => $this->profileModel->where(["users_id" => session('id')])->first(),
            'title' => 'Kepala Bidang | Profil'
        ];

        return view('kabid/profile', $data);
    }

    public function save_profile()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'namaLengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap Tidak Boleh Kosong!'
                    ],
                ],
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP Tidak Boleh Kosong!'
                    ],
                ],
                'ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanda Tangan Digital Tidak Boleh Kosong!'
                    ],
                ],
            ])) {
                $messeage = [
                    'error' => [
                        'namaLengkap' => $this->validation->getError('namaLengkap'),
                        'nip' => $this->validation->getError('nip'),
                        'ttd' => $this->validation->getError('ttd'),
                    ],
                ];
            } else {
                $users_id = $this->request->getPost('users_id');
                $nama = $this->request->getPost('namaLengkap');
                $nip = $this->request->getPost('nip');
                $signature = $this->request->getPost('ttd');

                $signatureImage = explode(";base64,", $signature);

                $getTypeImage = explode("image/", $signatureImage[0]);

                $typeImage = $getTypeImage[1];

                $decodeImage = base64_decode($signatureImage[1]);

                $createRandomImage = $nip . '-' . uniqid() . '.' . $typeImage;

                file_put_contents($createRandomImage, $decodeImage);

                $this->profileModel->save([
                    'users_id' => $users_id,
                    'namaLengkap' => ucwords($nama),
                    'nip' => $nip,
                    'ttd' => $createRandomImage
                ]);
                $messeage = [
                    'success' => 'Data Berhasil di Tambahkan!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function getProfile()
    {
        if ($this->request->isAJAX()) {
            $users_id = $this->request->getVar('users_id');

            $profileData = $this->profileModel->Where(["users_id" => $users_id])->first();

            return json_encode($profileData);
        }
    }
}
