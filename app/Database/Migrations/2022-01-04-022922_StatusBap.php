<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusBap extends Migration
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
            // 'penindakan_id' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => true,
            // ],
            'status_bap' => [
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
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('status_bap', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('status_bap');
    }
}
