<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'file_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_path' => ['type' => 'VARCHAR', 'constraint' => 500],
            'file_type' => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_size' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'alt_text' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'width' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'height' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'folder' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'uploads'],
            'uploaded_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('folder');
        $this->forge->createTable('media');
    }

    public function down()
    {
        $this->forge->dropTable('media');
    }
}
