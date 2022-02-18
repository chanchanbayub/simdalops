<?php

namespace App\Models\Operator;

use CodeIgniter\Model;

class SuratPengeluaranModel extends Model
{
    protected $table                = 'surat_pengeluaran';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['nomor_surat', 'ukpd_id',  'noBap', 'type_kendaraan_id', 'nopol', 'jenis_pelanggaran', 'lokasi_pelanggaran', 'tanggal_pelanggaran', 'pool_id', 'tahun_perakitan', 'nomor_rangka', 'nama_pemilik', 'alamat_pemilik', 'catatan', 'catatan_lain', 'tanggal_pengeluaran', 'rekomendasi_approv', 'status_surat_id', 'nomor_skrd', 'nominal_skrd', 'scan_kwitansi_sidang', 'scan_pengantar_sidang', 'scan_stuk', 'scan_kartu_pengawasan', 'surat_pernyataan', 'surat_permohonan', 'scan_stnk', 'scan_ktp', 'lain_lain'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    // protected $deletedField         = 'deleted_at';

    protected $fieldTable = 'surat_pengeluaran.id, nomor_surat, ukpd_id,  noBap, type_kendaraan_id, nopol, jenis_pelanggaran, lokasi_pelanggaran, tanggal_pelanggaran, pool_id, tahun_perakitan, nomor_rangka, nama_pemilik, alamat_pemilik, catatan, catatan_lain, tanggal_pengeluaran, rekomendasi_approv, status_surat_id, nomor_skrd, nominal_skrd, scan_kwitansi_sidang, scan_pengantar_sidang, scan_stuk, scan_kartu_pengawasan, surat_pernyataan, surat_permohonan, scan_stnk, scan_ktp, lain_lain, surat_pengeluaran.updated_at ,ukpd.ukpd, type_kendaraan.type_kendaraan, poolpenyimpanan.nama_terminal, status_surat.name';

    public function suratPengeluaranHarian($newDateTime)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
            ->join('status_surat', 'status_surat.id = status_surat_id')
            ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
            ->where(["tanggal_pengeluaran" =>  $newDateTime])
            ->orderBy('surat_pengeluaran.id desc');

        return [
            'suratPengeluaran' => $this
        ];
    }
    // Export Excel
    public function pengeluaranHarian($now)
    {
        return $this->db->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
            ->join('status_surat', 'status_surat.id = status_id')
            ->where(["tanggal_pengeluaran" =>  $now])
            ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
            ->orderBy('surat_pengeluaran.id desc')
            ->get()->getResultArray();
    }

    public function search($keyword, $dateTime = null)
    {
        if ($dateTime == null) {
            $this->table($this->table)
                ->like(['nopol' => $keyword])
                ->select($this->fieldTable)
                ->join('ukpd', 'ukpd.id = ukpd_id')
                ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
                ->join('status_surat', 'status_surat.id = status_surat_id')
                ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
                ->orderBy('surat_pengeluaran.id desc');
        } else {
            $this->table($this->table)
                ->like(['nopol' => $keyword])
                ->select($this->fieldTable)
                ->where(["tanggal_pengeluaran" => $dateTime])
                ->join('ukpd', 'ukpd.id = ukpd_id')
                ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
                ->join('status_surat', 'status_surat.id = status_surat_id')
                ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
                ->orderBy('surat_pengeluaran.id desc');
        }
        return [
            'suratPengeluaran' => $this
        ];
    }

    public function getNomorSurat($now, $pool_id)
    {
        $builder = $this->db->table('surat_pengeluaran')
            ->select($this->fieldTable)
            ->where(["tanggal_pengeluaran" => $now])
            ->where(["pool_id" => $pool_id])
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
            ->join('status_surat', 'status_surat.id = status_surat_id')
            ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id');
        $builder->selectMax('nomor_surat', 'nomor');
        $query = $builder->get()->getRowArray();

        return $query;
    }

    public function arsipSuratPengeluaran()
    {

        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
            ->join('status_surat', 'status_surat.id = status_surat_id')
            ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
            ->orderBy('surat_pengeluaran.id desc');

        return [
            'suratPengeluaran' => $this
        ];
    }

    public function getRowResult($id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["surat_pengeluaran.id " => $id])
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
            ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
            ->join('status_surat', 'status_surat.id = status_surat_id')
            ->get()->getRowArray();
    }

    public function totalPengeluaran($now = null)
    {
        if ($now == null) {
            return $this->db->table($this->table)
                ->countAllResults();
        } else {
            return $this->db->table($this->table)
                ->where(["tanggal_pengeluaran" => $now])
                ->countAllResults();
        }
    }

    public function getTotalPengandangan($nama_terminal, $now)
    {
        return $this->db->table($this->table)
            ->select($this->fieldTable)
            ->where(["nama_terminal " => $nama_terminal])
            ->join('ukpd', 'ukpd.id = ukpd_id')
            ->join('poolpenyimpanan', 'poolpenyimpanan.id = pool_id')
            ->join('status_surat', 'status_surat.id = status_surat_id')
            ->join('type_kendaraan', 'type_kendaraan.id = type_kendaraan_id')
            ->where(["tanggal_pengeluaran" => $now])
            ->countAllResults();
    }
}
