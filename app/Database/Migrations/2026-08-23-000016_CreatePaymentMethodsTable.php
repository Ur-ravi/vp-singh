<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'method_type' => ['type' => "ENUM('qr','bank')"],
            'label' => ['type' => 'VARCHAR', 'constraint' => 255],
            'qr_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'upi_id' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'account_holder' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'bank_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'account_number' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'ifsc' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'branch' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'account_type' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'instructions' => ['type' => 'TEXT', 'null' => true],
            'is_enabled' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('payment_methods');
    }

    public function down()
    {
        $this->forge->dropTable('payment_methods');
    }
}
