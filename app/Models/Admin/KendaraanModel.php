<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table                = 'klasifikasi_kendaraan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['nama_kendaraan'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getKlasifikasiKendaraan()
    {
        $this->table($this->table)
            ->select("*")
            ->get()->getResultArray();

        return [
            "klasifikasi_kendaraan" => $this
        ];
    }
}
