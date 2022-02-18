<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisBap extends Migration
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
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,

            ],
            'jenis_bap' => [
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
        $this->forge->addForeignKey('ukpd_id', 'ukpd', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('jenis_bap', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_bap');
    }
}
