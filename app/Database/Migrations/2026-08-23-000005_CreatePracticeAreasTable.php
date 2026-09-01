<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePracticeAreasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'short_description' => ['type' => 'TEXT', 'null' => true],
            'description' => ['type' => 'LONGTEXT', 'null' => true],
            'icon' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'cta_label' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Explore This Practice'],
            'is_featured' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
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
        $this->forge->createTable('practice_areas');
    }

    public function down()
    {
        $this->forge->dropTable('practice_areas');
    }
}
