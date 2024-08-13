<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnToTableRekening extends Migration
{
    public function up()
    {
        // Menambahkan kolom baru ke tabel users
        $this->forge->addColumn('tbl_rekening', [
            'user_id' => [
                'type' => 'INT',
                'after' => 'name' // optional, untuk menentukan posisi kolom baru
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_rekening', 'user_id');
    }
}
