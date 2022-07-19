<?php

namespace App\Models\Derek;

use CodeIgniter\Model;

class PenderekanModel extends Model
{
    protected $table                = 'penderekan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;

    protected $allowedFields        = ['ukpd_id', 'bap_id', 'penindakan_id', 'jenis_kendaraan_id', 'klasifikasi_id', 'kendaraan_id', 'tanggal_penindakan', 'jam_penindakan', 'tanggal_masuk_bap', 'nopol', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id', 'lokasi_pelanggaran', 'keterangan', 'pool_id', 'nama_pelanggar', 'alamat_pelanggar', 'warna_kendaraan', 'foto'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'penderekan.id,penderekan.ukpd_id, bap_id, penderekan.penindakan_id, penderekan.jenis_kendaaraan_id ,penderekan.klasifikasi_id, penderekan.kendaraan_id, penderekan.tanggal_penindakan, penderekan.jam_penindakan, penderekan.tanggal_masuk_bap, penderekan.nopol, penderekan.provinsi_id, penderekan.kota_id, penderekan.kecamatan_id, penderekan.kelurahan_id, penderekan.lokasi_pelanggaran, penderekan.keterangan, penderekan.pool_id, penderekan.nama_pelanggar, penderekan.alamat_pelanggar, penderekan.warna_kendaraan, penderekan.foto, kota.kabupaten_kota, unit_penindak.unit_penindak, bap.noBap, bap.nama_petugas, type_kendaraan.type_kendaraan, poolpenyimpanan.nama_terminal';

    public function getPenderekan()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('provinsi', 'provinsi.id = penderekan.provinsi_id', 'left')
            ->join('kota', 'kota.id = penderekan.kota_id', 'left')
            ->join('kecamatan', 'kota.id = penderekan.kecamatan_id', 'left')
            ->join('kelurahan', 'kota.id = penderekan.kelurahan_id', 'left')
            ->join('bap', 'bap.id = penderekan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id', 'left')
            ->join('jenispenindakan', 'jenispenindakan.id = penderekan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = penderekan.klasifikasi_id', 'left')
            ->join('type_kendaraan', 'type_kendaraan.id = penderekan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = penderekan.pool_id', 'left')
            ->join('ukpd', 'ukpd.id = penderekan.ukpd_id', 'left')
            ->where(["bap.status_id" => 2])
            ->orWhere(["bap.status_id" => 3])
            ->get()->getResultArray();
    }

    public function idPenderekan($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["penderekan.id" => $id])
            ->join('provinsi', 'provinsi.id = penderekan.provinsi_id', 'left')
            ->join('kota', 'kota.id = penderekan.kota_id', 'left')
            ->join('kecamatan', 'kota.id = penderekan.kecamatan_id', 'left')
            ->join('kelurahan', 'kota.id = penderekan.kelurahan_id', 'left')
            ->join('bap', 'bap.id = penderekan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('status_bap', 'status_bap.id = bap.status_id', 'left')
            ->join('jenispenindakan', 'jenispenindakan.id = penderekan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = penderekan.klasifikasi_id', 'left')
            ->join('type_kendaraan', 'type_kendaraan.id = penderekan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = penderekan.pool_id', 'left')
            ->join('ukpd', 'ukpd.id = penderekan.ukpd_id', 'left')
            ->where(["bap.status_id" => 2])
            ->orWhere(["bap.status_id" => 3])
            ->get()->getRowArray();
    }
}
