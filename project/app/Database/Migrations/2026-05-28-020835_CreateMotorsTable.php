<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMotorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'merek_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_motor' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'tipe' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'tahun' => [
                'type'       => 'YEAR',
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['tersedia', 'habis', 'indent'],
                'default'    => 'tersedia',
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        
        // Optimasi Index sesuai catatan dokumen database_schema.md
        $this->forge->addKey('tipe');
        $this->forge->addKey('status');

        // Foreign Key ke tabel merek
        $this->forge->addForeignKey('merek_id', 'merek', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('motors');
    }

    public function down()
    {
        $this->forge->dropTable('motors');
    }
}
