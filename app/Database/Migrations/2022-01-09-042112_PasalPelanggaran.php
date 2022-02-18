<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasalPelanggaran extends Migration
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
            'pasal_pelanggaran'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'keterangan'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('pasal_pelanggaran', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('pasal_pelanggaran');
    }
}
