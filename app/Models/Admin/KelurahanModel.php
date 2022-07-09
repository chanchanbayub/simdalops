<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $table                = 'kelurahan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id', 'kecamatan_id', 'kelurahan', 'kd_pos'];
}
