<?php

namespace App\Models\Auth;

use CodeIgniter\Model;

class AuthModel extends Model
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

    public function getDataUsers($username)
    {
        return $this->db->table($this->table)
            ->select('usersManagement.id, ukpd_id,role_id,username,password,status,ukpd,nama_dinas,role_management')
            ->where(["username" => $username])
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('role_management', 'role_management.id = role_id')
            ->get()->getRowArray();
    }
}
