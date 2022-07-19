<?php

namespace App\Models\Derek;

use CodeIgniter\Model;

class BapDerekModel extends Model
{
    protected $table                = 'bap';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;

    protected $allowedFields        = ['noBap', 'unit_id', 'nama_petugas', 'status_id', 'jenis_bap_id'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'bap.id, noBap, bap.unit_id, nama_petugas, status_id, bap.jenis_bap_id, unit_penindak.unit_penindak, status_bap.status_bap';
    // ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
    // ->join('status_bap', 'status_bap.id = bap.status_id')


    public function getBapDerek()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["bap.jenis_bap_id" => 1])
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id', 'left')
            ->where(["status_id" => 1])
            ->get()->getResultArray();
    }
}
