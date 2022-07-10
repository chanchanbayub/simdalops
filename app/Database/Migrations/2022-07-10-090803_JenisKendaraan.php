<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisKendaraan extends Migration
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
            'jenis_kendaraan' => [
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
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('jenis_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_kendaraan');
    }
}
