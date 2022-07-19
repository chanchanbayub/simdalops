<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penderekan extends Migration
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
            'bap_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
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
            'tanggal_penindakan' => [
                'type'      => 'date',
                'null' => false,
            ],
            'jam_penindakan' => [
                'type'      => 'time',
                'null' => true,
            ],
            'tanggal_masuk_bap' => [
                'type'      => 'date',
                'null' => false,
            ],
            'nopol' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'provinsi_id' => [
                'type'      => 'int',
                'constraint' => 100,
                'unsigned' => true
            ],
            'kota_id' => [
                'type'      => 'int',
                'constraint' => 100,
                'unsigned' => true
            ],
            'kecamatan_id' => [
                'type'      => 'int',
                'constraint' => 100,
                'unsigned' => true
            ],
            'kelurahan_id' => [
                'type'      => 'int',
                'constraint' => 100,
                'unsigned' => true
            ],
            'lokasi_pelanggaran' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'keterangan' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'pool_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => true,
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
            'warna_kendaraan' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'foto' => [
                'type'      => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addForeignKey('bap_id', 'bap', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('penindakan_id', 'jenispenindakan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('klasifikasi_id', 'klasifikasi_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kendaraan_id', 'type_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pool_id', 'poolpenyimpanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('provinsi_id', 'provinsi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kota_id', 'kota', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kelurahan_id', 'kelurahan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('penderekan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('penderekan');
    }
}
