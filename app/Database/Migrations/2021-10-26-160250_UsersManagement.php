<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersManagement extends Migration
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
                'null' => false
            ],
            'role_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null' => false,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'noHp' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
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
        $this->forge->addForeignKey('role_id', 'role_management', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pool_id', 'poolpenyimpanan', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('usersManagement', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('usersManagement');
    }
}
