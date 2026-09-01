<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConsultationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'booking_id' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'mobile' => ['type' => 'VARCHAR', 'constraint' => 20],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'city' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'legal_matter' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'consultation_mode' => ['type' => "ENUM('online','offline')", 'default' => 'online'],
            'preferred_date' => ['type' => 'DATE', 'null' => true],
            'preferred_time' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 2100.00],
            'payment_status' => ['type' => "ENUM('awaiting','submitted','verified','rejected','refunded')", 'default' => 'awaiting'],
            'booking_status' => ['type' => "ENUM('pending','confirmed','completed','cancelled')", 'default' => 'pending'],
            'notes' => ['type' => 'TEXT', 'null' => true],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('payment_status');
        $this->forge->addKey('booking_status');
        $this->forge->createTable('consultations');
    }

    public function down()
    {
        $this->forge->dropTable('consultations');
    }
}
