<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'location' => ['type' => 'VARCHAR', 'constraint' => 50, 'comment' => 'header, footer, sidebar'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menus');

        // Menu Items
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'menu_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'parent_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'label' => ['type' => 'VARCHAR', 'constraint' => 100],
            'url' => ['type' => 'VARCHAR', 'constraint' => 500],
            'target' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => '_self'],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'css_class' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'is_cta' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('menu_id');
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_items');
    }

    public function down()
    {
        $this->forge->dropTable('menu_items');
        $this->forge->dropTable('menus');
    }
}
