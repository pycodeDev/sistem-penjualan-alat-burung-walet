<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeDeskripsiToText extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tbl_product', [
            'deskripsi' => [
                'type' => 'TEXT',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('tbl_product', [
            'deskripsi' => [
                'type' => 'VARCHAR',
                'constraint' => 100, // Sesuaikan dengan tipe sebelumnya
            ],
        ]);
    }
}
