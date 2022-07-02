<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Kota extends Model
{
    protected $table                = 'kota';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id', 'province_id', 'name'];
}
