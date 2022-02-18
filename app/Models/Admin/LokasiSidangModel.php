<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class LokasiSidangModel extends Model
{
    protected $table                = 'lokasi_sidang';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['ukpd_id', 'lokasi_sidang'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getLokasiSidang()
    {
        $this->table($this->table)
            ->select('lokasi_sidang.id, lokasi_sidang.ukpd_id, lokasi_sidang, ukpd.ukpd')
            ->join('ukpd', 'ukpd.id = lokasi_sidang.ukpd_id')
            ->orderBy('lokasi_sidang.id DESC');

        return [
            'lokasi_sidang' => $this
        ];
    }
}
