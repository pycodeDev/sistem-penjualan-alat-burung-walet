<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnToTableTrx extends Migration
{
    public function up()
    {
         // Menambahkan kolom baru ke tabel users
         $this->forge->addColumn('tbl_trx', [
            'payment_method_id' => [
                'type' => 'INT',
                'after' => 'rek_id' // optional, untuk menentukan posisi kolom baru
            ],
            'payment_method_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'payment_method_id' // optional, untuk menentukan posisi kolom baru
            ],
            'payment_method_number' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'payment_method_name' // optional, untuk menentukan posisi kolom baru
            ],
        ]);
    }

    public function down()
    {
         // Menghapus kolom satu per satu
         $this->forge->dropColumn('tbl_trx', 'payment_method_id');
         $this->forge->dropColumn('tbl_trx', 'payment_method_name');
         $this->forge->dropColumn('tbl_trx', 'payment_method_number');
    }
}
