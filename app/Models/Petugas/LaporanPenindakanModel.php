<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class LaporanPenindakanModel extends Model
{

    protected $table                = 'laporan_penindakan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['ukpd_id', 'bap_id', 'penindakan_id', 'klasifikasi_id', 'kendaraan_id', 'tanggal_penindakan', 'tanggal_sidang', 'lokasi_sidang_id', 'jam_penindakan', 'nopol', 'pasal_pelanggaran_id', 'lokasi_pelanggaran', 'barang_bukti', 'pool_id', 'nama_pelanggar', 'tanggal_masuk_bap', 'alamat_pelanggar', 'warna_tnkb', 'tahun_perakitan', 'nomor_rangka', 'nama_pemilik', 'alamat_pemilik', 'foto'];
    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'laporan_penindakan.id,laporan_penindakan.ukpd_id, laporan_penindakan.bap_id, laporan_penindakan.penindakan_id, laporan_penindakan.klasifikasi_id, kendaraan_id, tanggal_penindakan, tanggal_sidang, lokasi_sidang_id, jam_penindakan, nopol, pasal_pelanggaran_id, lokasi_pelanggaran, barang_bukti, pool_id, nama_pelanggar, alamat_pelanggar, warna_tnkb, tahun_perakitan, nomor_rangka, nama_pemilik, alamat_pemilik, foto, bap.noBap, bap.unit_id, unit_penindak.unit_penindak, lokasi_sidang.lokasi_sidang, pasal_pelanggaran.pasal_pelanggaran, jenispenindakan.nama_penindakan, poolpenyimpanan.nama_terminal, klasifikasi_kendaraan.nama_kendaraan, pasal_pelanggaran.keterangan, bap.nama_petugas';


    public function getLaporanPenindakan($now, $unit_id)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["tanggal_penindakan" => $now])
            ->where(["bap.unit_id" => $unit_id])
            ->join('ukpd', 'ukpd.id = laporan_penindakan.ukpd_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('jenispenindakan', 'jenispenindakan.id = laporan_penindakan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = laporan_penindakan.klasifikasi_id', 'left')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id', 'left')
            ->join('lokasi_sidang', 'lokasi_sidang.id = laporan_penindakan.lokasi_sidang_id', 'left')
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = laporan_penindakan.pasal_pelanggaran_id', 'left')
            ->orderBy('laporan_penindakan.id desc');

        return [
            'laporan_penindakan' => $this
        ];
    }

    public function search($keyword)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->like(["noBap" => $keyword])
            ->orlike(["nopol" => $keyword])
            ->join('ukpd', 'ukpd.id = laporan_penindakan.ukpd_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('jenispenindakan', 'jenispenindakan.id = laporan_penindakan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = laporan_penindakan.klasifikasi_id', 'left')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id', 'left')
            ->join('lokasi_sidang', 'lokasi_sidang.id = laporan_penindakan.lokasi_sidang_id', 'left')
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = laporan_penindakan.pasal_pelanggaran_id', 'left')
            ->orderBy('laporan_penindakan.id desc');

        return [
            'laporan_penindakan' => $this
        ];
    }

    public function totalPerRegu($unit_id, $now)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = laporan_penindakan.ukpd_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('jenispenindakan', 'jenispenindakan.id = laporan_penindakan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = laporan_penindakan.klasifikasi_id', 'left')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id', 'left')
            ->join('lokasi_sidang', 'lokasi_sidang.id = laporan_penindakan.lokasi_sidang_id', 'left')
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = laporan_penindakan.pasal_pelanggaran_id', 'left')

            ->where(["bap.unit_id" => $unit_id])
            ->where(["tanggal_penindakan" => $now])
            ->countAllResults();
    }

    public function getDataPenindakan($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(['laporan_penindakan.id' => $id])
            ->join('ukpd', 'ukpd.id = laporan_penindakan.ukpd_id')
            ->join('bap', 'bap.id = laporan_penindakan.bap_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('jenispenindakan', 'jenispenindakan.id = laporan_penindakan.penindakan_id', 'left')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = laporan_penindakan.klasifikasi_id')
            ->join('type_kendaraan', 'type_kendaraan.id = laporan_penindakan.kendaraan_id', 'left')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = laporan_penindakan.pool_id', 'left')
            ->join('lokasi_sidang', 'lokasi_sidang.id = laporan_penindakan.lokasi_sidang_id', 'left')
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = laporan_penindakan.pasal_pelanggaran_id')
            ->get()->getRowArray();
    }
}
