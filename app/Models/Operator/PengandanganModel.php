<?php

namespace App\Models\Operator;

use CodeIgniter\Model;

class PengandanganModel extends Model
{
    protected $table                = 'pengandangan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['laporan_penindakan_id', 'status_kendaraan', 'tanggal_keluar', 'foto_kendaraan_masuk', 'foto_kendaraan_keluar'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'pengandangan.id, laporan_penindakan_id, status_kendaraan, tanggal_keluar, foto_kendaraan_masuk, foto_kendaraan_keluar, laporan_penindakan.tanggal_penindakan, laporan_penindakan.nopol, type_kendaraan.type_kendaraan, poolpenyimpanan.nama_terminal, laporan_penindakan.nama_pelanggar';

    public function getDataKendaraan()
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('laporan_penindakan', 'laporan_penindakan.id = pengandangan.laporan_penindakan_id')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->orderBy('pengandangan.id desc');

        return [
            'pengandangan' => $this
        ];
    }

    public function search($keyword)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('laporan_penindakan', 'laporan_penindakan.id = pengandangan.laporan_penindakan_id')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->like(["laporan_penindakan.nopol" => $keyword])
            ->orderBy('pengandangan.id desc');

        return [
            'pengandangan' => $this
        ];
    }
}
