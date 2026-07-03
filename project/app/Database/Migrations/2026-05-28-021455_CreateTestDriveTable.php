<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestDriveTable extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'motor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_test' => [
                'type'       => 'DATE',
            ],
            'waktu' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'catatan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu', 'disetujui', 'ditolak', 'selesai'],
                'default'    => 'menunggu',
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        
        // Foreign Keys
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('motor_id', 'motors', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('test_drive');
    }

    public function down()
    {
        $this->forge->dropTable('test_drive');
    }
}
