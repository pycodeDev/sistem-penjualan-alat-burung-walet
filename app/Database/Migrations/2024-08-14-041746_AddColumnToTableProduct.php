<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnToTableProduct extends Migration
{
    public function up()
    {
         // Menambahkan kolom baru ke tabel users
         $this->forge->addColumn('tbl_product', [
            'deskripsi' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'image' // optional, untuk menentukan posisi kolom baru
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_product', 'deskripsi');
    }
}
