<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_lengkap' => 'Admin MotoShow',
                'email'        => 'admin@gmail.com',
                // Password di-hash menggunakan password_hash() sesuai catatan dokumen
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'no_telepon'   => '081122334455',
                'role'         => 'admin',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lengkap' => 'Budi Santoso',
                'email'        => 'pembeli@gmail.com', // Sesuai dengan data di api_contract.md
                'password'     => password_hash('password123', PASSWORD_BCRYPT),
                'no_telepon'   => '081234567890',
                'role'         => 'user',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
