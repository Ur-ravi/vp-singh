<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'excerpt' => ['type' => 'TEXT', 'null' => true],
            'content' => ['type' => 'LONGTEXT', 'null' => true],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'author_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status' => ['type' => "ENUM('draft','published','scheduled')", 'default' => 'draft'],
            'published_at' => ['type' => 'DATETIME', 'null' => true],
            'scheduled_at' => ['type' => 'DATETIME', 'null' => true],
            'view_count' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'seo_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'seo_description' => ['type' => 'TEXT', 'null' => true],
            'seo_og_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'seo_canonical' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'seo_robots' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'index, follow'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('category_id');
        $this->forge->addKey('author_id');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('author_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('blog_posts');
    }

    public function down()
    {
        $this->forge->dropTable('blog_posts');
    }
}
