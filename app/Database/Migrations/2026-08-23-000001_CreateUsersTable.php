<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 30, 'unique' => true, 'null' => true],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => "ENUM('super_admin','editor')", 'default' => 'editor'],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'last_login' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
