<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table                = 'klasifikasi_kendaraan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['jenis_kendaraan_id', 'nama_kendaraan'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'klasifikasi_kendaraan.id, klasifikasi_kendaraan.jenis_kendaraan_id, klasifikasi_kendaraan.nama_kendaraan,  jenis_kendaraan.jenis_kendaraan';

    public function getKlasifikasiKendaraan()
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('jenis_kendaraan', 'jenis_kendaraan.id = klasifikasi_kendaraan.jenis_kendaraan_id', 'left');

        return [
            "klasifikasi_kendaraan" => $this
        ];
    }

    // public function data()
    // {
    //     return $this->table($this->table)
    //         ->select($this->fieldTable)
    //         ->join('jenis_kendaraan', 'jenis_kendaraan.id = klasifikasi_kendaraan.jenis_kendaraan_id')
    //         ->get()->getResultArray();
    // }
}
