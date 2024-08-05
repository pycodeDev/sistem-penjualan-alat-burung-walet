<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTrx extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'nama_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'rek_id' => [
                'type'       => 'INT',
                'unsigned'       => true,
            ],
            'total' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'price' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'comment' => "PENDING | KONFIRM | SHIPPING | SUCCESS",
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
        $this->forge->createTable('tbl_trx');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_trx');
    }
}
