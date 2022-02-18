<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusSurat extends Migration
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
            'name'       => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
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
        $this->forge->createTable('status_surat', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('status_surat');
    }
}
