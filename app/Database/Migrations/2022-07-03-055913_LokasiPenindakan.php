<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LokasiPenindakan extends Migration
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
            'bap_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'provinsi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,

            ],
            'kota_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,

            ],
            'kecamatan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kelurahan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addForeignKey('bap_id', 'laporan_penindakan', 'bap_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('provinsi_id', 'provinsi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kota_id', 'kota', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kelurahan_id', 'kelurahan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('lokasi_penindakan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('lokasi_penindakan');
    }
}
