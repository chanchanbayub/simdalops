<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UsersManagementModel extends Model
{
    protected $table                = 'usersManagement';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['ukpd_id', 'role_id', 'username', 'password', 'noHp', 'status'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getAllUsersManagement()
    {
        $this->table($this->table)
            ->select('usersManagement.id, usersManagement.ukpd_id, username, password, role_management.role_management, status,noHp ,ukpd.ukpd')
            ->join('ukpd', 'ukpd.id = usersManagement.ukpd_id')
            ->join('role_management', 'role_management.id = usersManagement.role_id')
            ->orderBy('usersManagement.id desc');

        return [
            'users' => $this
        ];
    }

    public function getIdUser($id)
    {
        return $this->table($this->table)
            ->select('usersManagement.id, profile.ttd')
            ->join('profile', 'profile.users_id = usersManagement.id', 'left')
            ->where(["usersManagement.id" => $id])
            ->get()->getRowArray();
    }
}
