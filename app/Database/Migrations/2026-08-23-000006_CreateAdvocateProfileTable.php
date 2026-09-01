<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdvocateProfileTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'designation' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Advocate'],
            'biography' => ['type' => 'LONGTEXT', 'null' => true],
            'profile_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'education' => ['type' => 'TEXT', 'null' => true],
            'experience' => ['type' => 'TEXT', 'null' => true],
            'court_info' => ['type' => 'TEXT', 'null' => true],
            'practice_area_ids' => ['type' => 'JSON', 'null' => true],
            'memberships' => ['type' => 'TEXT', 'null' => true],
            'credentials' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('advocate_profile');
    }

    public function down()
    {
        $this->forge->dropTable('advocate_profile');
    }
}
