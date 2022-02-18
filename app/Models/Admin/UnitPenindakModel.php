<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UnitPenindakModel extends Model
{

    protected $table                = 'unit_penindak';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;

    protected $allowedFields        = ['ukpd_id', 'unit_penindak', 'jenis_bap_id'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'unit_penindak.id, unit_penindak.ukpd_id, unit_penindak.unit_penindak, ukpd.ukpd, jenis_bap.jenis_bap';

    public function getDataUnitPenindak()
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = unit_penindak.ukpd_id')
            ->join('jenis_bap', 'jenis_bap.id = unit_penindak.jenis_bap_id')
            ->orderBy("unit_penindak.id desc");

        return [
            'unit_penindak' => $this
        ];
    }
}
