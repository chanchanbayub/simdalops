<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class BapModel extends Model
{
    protected $table                = 'bap';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;

    protected $allowedFields        = ['noBap', 'unit_id', 'nama_petugas', 'status_id'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'bap.id, noBap, bap.unit_id, nama_petugas, status_id, unit_penindak.unit_penindak, status_bap.status_bap, laporan_penindakan.foto, laporan_penindakan.nopol, laporan_penindakan.tanggal_penindakan, laporan_penindakan.jam_penindakan, laporan_penindakan.tanggal_masuk_bap';
    // ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
    // ->join('status_bap', 'status_bap.id = bap.status_id')
    public function totalBAP($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["unit_id" => $id])
            ->countAllResults();
    }

    public function totalBapKeluar($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["unit_id" => $id])
            ->where(["status_id" => 1])
            ->countAllResults();
    }

    public function totalBapAktif($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["unit_id" => $id])
            ->where(["status_id" => 2])
            ->countAllResults();
    }

    public function totalBapMasuk($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["unit_id" => $id])
            ->where(["status_id" => 4])
            // ->orWhere(["status_id" => 4])
            ->countAllResults();
    }

    public function getDataBap($unit_id)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('laporan_penindakan', 'laporan_penindakan.bap_id = bap.id', 'left')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id', 'left')
            ->where(['unit_id' => $unit_id])
            ->where(['status_id' => 1])
            ->orderBy('bap.id DESC');

        return [
            "bap" => $this
        ];
    }

    public function search($keyword, $unit_id)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('laporan_penindakan', 'laporan_penindakan.bap_id = bap.id', 'left')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id', 'left')
            ->like(["bap.noBap" => $keyword])
            ->orLike(["laporan_penindakan.nopol" => $keyword])
            ->where(['unit_id' => $unit_id])
            ->orderBy('bap.id DESC');

        return [
            "bap" => $this
        ];
    }

    public function getNoBap($noBap, $unit_id)
    {
        return $this->db->table($this->table)
            ->select($this->fieldTable)
            ->join('laporan_penindakan', 'laporan_penindakan.bap_id = bap.id', 'left')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id', 'left')
            ->where(["bap.noBap" => $noBap])
            ->where(['unit_id' => $unit_id])
            ->orderBy('bap.id DESC')
            ->get()->getRowArray();
    }
}
