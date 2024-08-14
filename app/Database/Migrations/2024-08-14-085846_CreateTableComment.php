<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableComment extends Migration
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
            'user_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'product_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'comment' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->createTable('tbl_comment');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_comment');
    }
}
