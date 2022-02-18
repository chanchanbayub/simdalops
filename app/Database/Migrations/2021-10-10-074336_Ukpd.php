<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ukpd extends Migration
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
            'ukpd'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'nama_dinas' => [
                'type' => 'VARCHAR',
                'null' => true,
                'constraint' => '100'
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
        $this->forge->createTable('ukpd', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('ukpd');
    }
}
