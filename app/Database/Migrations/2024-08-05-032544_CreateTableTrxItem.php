<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTrxItem extends Migration
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
            'trx_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'item_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'barang_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
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
            'created' => [
                'type' => 'DATE',
                'null' => true,
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
        $this->forge->createTable('tbl_trx_item');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_trx_item');
    }
}
