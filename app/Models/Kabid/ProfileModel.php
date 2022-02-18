<?php

namespace App\Models\Kabid;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table                = 'profile';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;

    protected $allowedFields        = ['users_id', 'namaLengkap', 'nip', 'ttd'];

    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getProfileName($role)
    {
        return $this->table($this->table)
            ->select('profile.id, users_id, namaLengkap, nip, ttd, usersManagement.role_id, role_management.role_management',)
            ->join('usersManagement', 'usersManagement.id = profile.users_id')
            ->join('role_management', 'role_management.id = usersManagement.role_id')
            ->where(["role_management" => $role])
            ->get()->getRowArray();
    }
}
