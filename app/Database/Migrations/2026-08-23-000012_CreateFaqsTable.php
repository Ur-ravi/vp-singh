<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFaqsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'question' => ['type' => 'VARCHAR', 'constraint' => 500],
            'answer' => ['type' => 'LONGTEXT'],
            'assignable_type' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'comment' => 'page, practice_area, blog_post, or global'],
            'assignable_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'is_published' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['assignable_type', 'assignable_id']);
        $this->forge->createTable('faqs');
    }

    public function down()
    {
        $this->forge->dropTable('faqs');
    }
}
