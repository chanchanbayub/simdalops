<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class StatusSuratModel extends Model
{
    protected $table                = 'status_surat';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['name'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
}
