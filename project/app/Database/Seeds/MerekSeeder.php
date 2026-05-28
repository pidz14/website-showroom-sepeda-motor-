<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MerekSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_merek' => 'Honda', 'logo' => '/assets/img/merek/honda.png'],
            ['nama_merek' => 'Yamaha', 'logo' => '/assets/img/merek/yamaha.png'],
            ['nama_merek' => 'Suzuki', 'logo' => '/assets/img/merek/suzuki.png'],
            ['nama_merek' => 'Kawasaki', 'logo' => '/assets/img/merek/kawasaki.png'],
            ['nama_merek' => 'TVS', 'logo' => '/assets/img/merek/tvs.png'],
        ];

        $this->db->table('merek')->insertBatch($data);
    }
}
