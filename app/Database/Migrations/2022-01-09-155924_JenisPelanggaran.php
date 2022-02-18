<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisPelanggaran extends Migration
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
            'pasal_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'jenis_pelanggaran' => [
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
        $this->forge->addForeignKey('pasal_id', 'pasal_pelanggaran', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('jenis_pelanggaran', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('pasal_pelanggaran');
    }
}
