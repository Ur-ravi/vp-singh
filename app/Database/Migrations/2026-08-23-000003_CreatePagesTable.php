<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'content' => ['type' => 'LONGTEXT', 'null' => true],
            'excerpt' => ['type' => 'TEXT', 'null' => true],
            'template' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'default'],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'is_published' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'seo_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'seo_description' => ['type' => 'TEXT', 'null' => true],
            'seo_og_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'seo_canonical' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'seo_robots' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'index, follow'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pages');
    }

    public function down()
    {
        $this->forge->dropTable('pages');
    }
}
