<?php

namespace App\Models\Operator;

use CodeIgniter\Model;

class BapModel extends Model
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

    protected $fieldTable = 'bap.id, noBap,unit_id, nama_petugas, status_id, unit_penindak, status_bap, jenis_bap.jenis_bap, bap.created_at';

    public function getNoBap()
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('jenis_bap', 'jenis_bap.id = bap.jenis_bap_id')
            ->orderBy('id desc');

        return [
            'noBap' => $this
        ];
    }

    public function search($keyword)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('jenis_bap', 'jenis_bap.id = bap.jenis_bap_id')
            ->like(['noBap' => $keyword])
            ->orLike(['status_bap' => $keyword])
            ->orLike(["unit_penindak" => $keyword])
            ->orLike(["nama_petugas" => $keyword]);

        return [
            'noBap' => $this
        ];
    }

    public function getBapKeluar($unit, $status_id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->where(["unit_penindak" => $unit])
            ->where(["status_id" => $status_id])
            ->countAllResults();
    }
}
