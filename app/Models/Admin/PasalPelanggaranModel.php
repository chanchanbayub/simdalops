<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PasalPelanggaranModel extends Model
{
    protected $table                = 'pasal_pelanggaran';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['pasal_pelanggaran', 'keterangan'];
    protected $useTimestamps        = true;

    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getPasal()
    {
        $this->table($this->table)
            ->orderBy('pasal_pelanggaran.id desc');

        return [
            'pasal_pelanggaran' => $this
        ];
    }

    public function search($keyword)
    {
        $this->table($this->table)
            ->like(["pasal_pelanggaran" => $keyword])
            ->orderBy('id DESC');

        return [
            'pasal_pelanggaran' => $this
        ];
    }
}
