<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnquiriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'city' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'subject' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'legal_matter' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'message' => ['type' => 'TEXT'],
            'source_page' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => "ENUM('new','contacted','consultation_booked','converted','closed')", 'default' => 'new'],
            'admin_notes' => ['type' => 'TEXT', 'null' => true],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->createTable('enquiries');
    }

    public function down()
    {
        $this->forge->dropTable('enquiries');
    }
}
