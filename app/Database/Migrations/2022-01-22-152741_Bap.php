<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bap extends Migration
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
            'noBap' => [
                'type'      => 'VARCHAR',
                'constraint' => 11,
                'null' => true,
            ],
            'unit_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'nama_petugas'  => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'status_id'  => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'unsigned' => true
            ],
            'jenis_bap_id'  => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
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
        $this->forge->addForeignKey('unit_id', 'unit_penindak', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status_bap', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jenis_bap_id', 'jenis_bap', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('bap', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('bap');
    }
}
