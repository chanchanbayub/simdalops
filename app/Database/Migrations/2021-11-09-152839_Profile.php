<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profile extends Migration
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
            'users_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'namaLengkap'       => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'nip'       => [
                'type'      => 'INT',
                'constraint' => 100,
                'null' => false,
            ],
            'ttd' => [
                'type'      => 'VARCHAR',
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
        $this->forge->addForeignKey('users_id', 'usersManagement', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('profile', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('profile');
    }
}
