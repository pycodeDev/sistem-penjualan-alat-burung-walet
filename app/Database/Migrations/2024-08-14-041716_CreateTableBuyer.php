<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBuyer extends Migration
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
            'buyer_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'supplier_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'qty' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'price' => [
                'type' => 'INT',
                'unsigned'       => true,
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
        $this->forge->createTable('tbl_buyer');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_buyer');
    }
}
