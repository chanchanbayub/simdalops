<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporanharian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ukpd_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'unit_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'noBap'       => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'penindakan_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'klasifikasi_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'kendaraan_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'kendaraan_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'tanggal_penindakan' => [
                'type'      => 'date',
                'null' => false,
            ],
            'tanggal_sidang' => [
                'type'      => 'date',
                'null' => false,
            ],
            'lokasi_sidang' => [
                'type' => 'varchar',
                'null' => false,
                'constraint' => 100
            ],
            'jam_penindakan' => [
                'type'      => 'time',
                'null' => false,
            ],
            'nopol' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'jenis_pelanggaran' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'pasal_pelanggaran' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'lokasi_pelanggaran' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'barang_bukti' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'pool_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'nama_pelanggar' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'alamat_pelanggar' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'warna_tnkb' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tahun_perakitan' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'nomor_rangka' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'nama_pemilik' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'alamat_pemilik' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => false
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ukpd_id', 'ukpd', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('unit_id', 'unit_penindak', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('penindakan_id', 'jenispenindakan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('klasifikasi_id', 'klasifikasi_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kendaraan_id', 'type_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pool_id', 'poolpenyimpanan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('laporan_harian', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('laporan_harian');
    }
}
