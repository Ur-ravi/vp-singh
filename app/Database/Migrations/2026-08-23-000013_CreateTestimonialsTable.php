<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'client_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'review' => ['type' => 'TEXT'],
            'rating' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 5],
            'location' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'source' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'is_published' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('testimonials');
    }

    public function down()
    {
        $this->forge->dropTable('testimonials');
    }
}
