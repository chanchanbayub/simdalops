<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PoolPenyimpananModel extends Model
{
    protected $table                = 'poolpenyimpanan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['penindakan_id', 'nama_terminal'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    public function getPoolPenyimpanan()
    {
        $this->table($this->table)
            ->select('poolpenyimpanan.id, penindakan_id, nama_terminal, nama_penindakan')
            ->join('jenispenindakan', 'jenispenindakan.id = poolpenyimpanan.penindakan_id')
            ->orderBy('poolpenyimpanan.id desc');

        return [
            'pool_penyimpanan' => $this
        ];
    }
}
