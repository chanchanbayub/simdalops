<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kendaraan extends Migration
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
            'jenis_kendaraan_id' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => true,
                'unsigned' => true,
            ],
            'nama_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
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
        $this->forge->addForeignKey('jenis_kendaraan_id', 'jenis_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('klasifikasi_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('klasifikasi_kendaraan');
    }
}
