<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UkpdModel extends Model
{
    protected $table                = 'ukpd';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['ukpd', 'nama_dinas'];
    protected $useTimestamps        = true;

    // Dates

    // protected $dateFormat           = 'datetime';
    // protected $createdField         = 'created_at';
    // protected $updatedField         = 'updated_at';
    // protected $deletedField         = 'deleted_at';

}
