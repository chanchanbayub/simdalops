<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Provinsi extends Model
{
    protected $table                = 'provinsi';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id', 'name'];
}
