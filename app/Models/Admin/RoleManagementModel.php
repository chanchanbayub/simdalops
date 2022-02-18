<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class RoleManagementModel extends Model
{
    protected $table                = 'role_management';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['role_management'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getRoleManagement($roleManagement)
    {
        return $this->table($this->table)
            ->select('role_management.id, role_management, users_id, namaLengkap, nip, ttd')
            ->where(["role_management" => $roleManagement])
            ->join('profile', 'profile.users_id = role_management.id', 'left')
            ->get()->getRowArray();
    }
}
