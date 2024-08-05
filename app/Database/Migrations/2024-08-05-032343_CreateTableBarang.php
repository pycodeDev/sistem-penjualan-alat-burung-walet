<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_id' => [
                'type'       => 'INT',
                'unsigned'       => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'stok' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'image' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_product');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_product');
    }
}
