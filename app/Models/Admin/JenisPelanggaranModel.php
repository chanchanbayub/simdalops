<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JenisPelanggaranModel extends Model
{
    protected $table                = 'jenis_pelanggaran';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['pasal_id', 'jenis_pelanggaran'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $fieldTable = 'jenis_pelanggaran.id, pasal_id, jenis_pelanggaran, pasal_pelanggaran';

    public function getJenisPelanggaran()
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = jenis_pelanggaran.pasal_id')
            ->orderBy('jenis_pelanggaran.id DESC');

        return [
            'jenis_pelanggaran' => $this
        ];
    }

    public function search($keyword)
    {
        $this->table($this->table)
            ->select($this->fieldTable)
            ->join('pasal_pelanggaran', 'pasal_pelanggaran.id = jenis_pelanggaran.pasal_id')
            ->like(['pasal_pelanggaran' => $keyword])
            ->orLike(["jenis_pelanggaran" => $keyword])
            ->orderBy('jenis_pelanggaran.id Desc');

        return [
            'jenis_pelanggaran' => $this
        ];
    }
}
