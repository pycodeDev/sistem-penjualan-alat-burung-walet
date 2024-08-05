<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKonfirmasiPembayaran extends Migration
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
            'image' => [
                'type' => 'TEXT',
            ],
            'admin_id' => [
                'type'       => 'INT',
                'unsigned'       => true,
            ],
            'note' => [
                'type'       => 'TEXT',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'comment' => "PENDING | SUCCESS | FAILED",
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
        $this->forge->createTable('tbl_payment_confirm');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_payment_confirm');
    }
}
