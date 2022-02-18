<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitPenindak extends Migration
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
            'unit_penindak'       => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'jenis_bap_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
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
        $this->forge->addForeignKey('jenis_bap_id', 'jenis_bap', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('unit_penindak', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('unit_penindak');
    }
}
