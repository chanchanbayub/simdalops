<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataPengandangan extends Migration
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
            'laporan_penindakan_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status_kendaraan' => [
                'type' => 'Varchar',
                'constraint' => 200,
                'null' => true
            ],
            'tanggal_keluar' => [
                'type' => 'date',
                'null' => true
            ],
            'foto_kendaraan_masuk' => [
                'type' => 'Varchar',
                'constraint' => 200,
                'null' => true
            ],
            'foto_kendaraan_keluar' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
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
        $this->forge->addForeignKey('laporan_penindakan_id', 'laporan_penindakan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('pengandangan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('pengandangan');
    }
}
