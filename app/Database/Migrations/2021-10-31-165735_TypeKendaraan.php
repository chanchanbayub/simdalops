<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeKendaraan extends Migration
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
            'klasifikasi_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'type_kendaraan' => [
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
        $this->forge->addForeignKey('klasifikasi_id', 'klasifikasi_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('type_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('type_kendaraan');
    }
}
