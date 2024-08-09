<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnToTableTrx extends Migration
{
    public function up()
    {
        // Menambahkan kolom baru ke tabel users
        $this->forge->addColumn('tbl_trx', [
            'rek_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'rek_id' // optional, untuk menentukan posisi kolom baru
            ],
            'rek_number' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'rek_name' // optional, untuk menentukan posisi kolom baru
            ],
        ]);
    }

    public function down()
    {
        // Menghapus kolom satu per satu
        $this->forge->dropColumn('tbl_trx', 'rek_name');
        $this->forge->dropColumn('tbl_trx', 'rek_number');
    }
}
