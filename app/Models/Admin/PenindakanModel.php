<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PenindakanModel extends Model
{
    protected $table                = 'jenispenindakan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['nama_penindakan'];
    protected $useTimestamps        = true;

    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
}
