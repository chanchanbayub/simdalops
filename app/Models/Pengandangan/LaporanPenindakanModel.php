<?php

namespace App\Models\Pengandangan;

use CodeIgniter\Model;

class LaporanPenindakanModel extends Model
{
    protected $table                = 'laporan_penindakan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['ukpd_id', 'bap_id', 'penindakan_id', 'klasifikasi_id', 'kendaraan_id', 'tanggal_penindakan', 'tanggal_sidang', 'lokasi_sidang_id', 'jam_penindakan', 'nopol', 'tanggal_masuk_bap', 'jenis_pelanggaran', 'pasal_pelanggaran_id', 'lokasi_pelanggaran', 'barang_bukti', 'pool_id', 'nama_pelanggar', 'alamat_pelanggar', 'warna_tnkb', 'tahun_perakitan', 'nomor_rangka', 'nama_pemilik', 'alamat_pemilik', 'foto', 'catatan'];
    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable           = 'laporan_penindakan.id,laporan_penindakan.ukpd_id, bap_id, laporan_penindakan.penindakan_id, laporan_penindakan.klasifikasi_id, kendaraan_id, tanggal_penindakan, tanggal_sidang, lokasi_sidang_id, jam_penindakan, nopol, jenis_pelanggaran, tanggal_masuk_bap, pasal_pelanggaran_id, lokasi_pelanggaran, barang_bukti, pool_id, nama_pelanggar, alamat_pelanggar, warna_tnkb, tahun_perakitan, nomor_rangka, nama_pemilik, alamat_pemilik, foto, catatan,bap.noBap, bap.unit_id, unit_penindak.unit_penindak, status_bap.status_bap, bap.status_id ,ukpd.ukpd, lokasi_sidang.lokasi_sidang, type_kendaraan.type_kendaraan, jenispenindakan.nama_penindakan, klasifikasi_kendaraan.nama_kendaraan, pasal_pelanggaran.pasal_pelanggaran, poolpenyimpanan.nama_terminal, bap.noBap, bap.nama_petugas';

    public function getPenindakan($now, $pool_id, $ukpd_id)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = laporan_penindakan.ukpd_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('jenispenindakan', 'jenispenindakan.id = laporan_penindakan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = laporan_penindakan.klasifikasi_id', 'left')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id', 'left')
            ->join('lokasi_sidang', 'lokasi_sidang.id = laporan_penindakan.lokasi_sidang_id', 'left')
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = laporan_penindakan.pasal_pelanggaran_id')
            ->where(["laporan_penindakan.ukpd_id" => $ukpd_id])
            ->where(["pool_id" => $pool_id])
            ->where(["tanggal_penindakan" => $now])
            ->where(["status_id" => 2])
            ->where(["nama_penindakan" => 'Stop Operasi'])
            ->orderBy('laporan_penindakan.id desc');

        return [
            'laporan_penindakan' => $this
        ];
    }
}
