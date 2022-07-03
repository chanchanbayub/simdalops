<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class LokasiPenindakanModel extends Model
{
    protected $table                = 'lokasi_penindakan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id', 'bap_id', 'province_id', 'regency_id', 'kecamatan_id'];
    protected $useTimestamps        = true;

    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
}
