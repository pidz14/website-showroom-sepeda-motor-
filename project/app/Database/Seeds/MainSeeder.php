<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder dengan urutan tabel master dulu baru tabel transaksi
        $this->call('MerekSeeder');
        $this->call('UserSeeder');
        $this->call('MotorSeeder');
    }
}

// untuk refresh database, jalankan perintah berikut di terminal:
// php spark migrate:refresh --all && php spark db:seed MainSeeder