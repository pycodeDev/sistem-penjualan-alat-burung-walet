<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMetodePembayaran extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'image' => [
                'type' => 'TEXT',
            ],
            'rekening' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'rekening_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type' => 'INT',
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
        $this->forge->createTable('tbl_payment_method');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_payment_method');
    }
}
