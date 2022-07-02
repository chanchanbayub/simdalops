<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Kecamatan extends Model
{
    protected $table                = 'kecamatan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id', 'regency_id', 'name'];
}
