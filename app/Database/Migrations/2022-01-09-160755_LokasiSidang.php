<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LokasiSidang extends Migration
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
            'ukpd_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'lokasi_sidang' => [
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
        $this->forge->addForeignKey('ukpd_id', 'ukpd', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('lokasi_sidang', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('lokasi_sidang');
    }
}
