<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'consultation_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'client_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'mobile' => ['type' => 'VARCHAR', 'constraint' => 20],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'payment_method' => ['type' => "ENUM('upi','bank_transfer')", 'default' => 'upi'],
            'utr_number' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'screenshot' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'status' => ['type' => "ENUM('awaiting','submitted','verified','rejected','refunded')", 'default' => 'awaiting'],
            'admin_notes' => ['type' => 'TEXT', 'null' => true],
            'verified_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('consultation_id');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('consultation_id', 'consultations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
