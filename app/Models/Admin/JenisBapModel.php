<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JenisBapModel extends Model
{
    protected $table                = 'jenis_bap';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['ukpd_id', 'jenis_bap'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'jenis_bap.id, ukpd_id, jenis_bap, ukpd.ukpd';

    public function getJenisBAP()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = jenis_bap.ukpd_id')
            ->orderBy('jenis_bap.id DESC')
            ->get()->getResultArray();
    }
}
