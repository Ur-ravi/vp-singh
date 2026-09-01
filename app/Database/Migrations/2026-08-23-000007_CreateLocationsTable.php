<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'office_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'address' => ['type' => 'TEXT', 'null' => true],
            'city' => ['type' => 'VARCHAR', 'constraint' => 100],
            'state' => ['type' => 'VARCHAR', 'constraint' => 100],
            'pin' => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'whatsapp' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'google_maps_url' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'latitude' => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
            'office_hours' => ['type' => 'TEXT', 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('locations');
    }

    public function down()
    {
        $this->forge->dropTable('locations');
    }
}
