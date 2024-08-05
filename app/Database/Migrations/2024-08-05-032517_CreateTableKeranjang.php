<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKeranjang extends Migration
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
                'type'       => 'INT',
            ],
            'product_id' => [
                'type' => 'INT',
            ],
            'qty' => [
                'type'       => 'INT',
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
        $this->forge->createTable('tbl_cart');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_cart');
    }
}
