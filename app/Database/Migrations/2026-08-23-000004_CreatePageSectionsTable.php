<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePageSectionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'page_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'section_key' => ['type' => 'VARCHAR', 'constraint' => 100],
            'section_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'section_content' => ['type' => 'LONGTEXT', 'null' => true],
            'section_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'section_data' => ['type' => 'JSON', 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_visible' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('page_id');
        $this->forge->addForeignKey('page_id', 'pages', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('page_sections');
    }

    public function down()
    {
        $this->forge->dropTable('page_sections');
    }
}
