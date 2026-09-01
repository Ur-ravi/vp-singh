<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeoMetadataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'metaable_type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'metaable_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'seo_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'TEXT', 'null' => true],
            'og_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'og_description' => ['type' => 'TEXT', 'null' => true],
            'og_image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'canonical_url' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'robots' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'index, follow'],
            'schema_markup' => ['type' => 'JSON', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('seo_metadata');
    }

    public function down()
    {
        $this->forge->dropTable('seo_metadata');
    }
}
