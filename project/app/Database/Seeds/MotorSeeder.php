<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MotorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'merek_id'   => 1, // Honda (berelasi ke id 1 di MerekSeeder)
                'nama_motor' => 'Honda Vario 160',
                'tipe'       => 'matic',
                'tahun'      => '2024',
                'harga'      => 24500000.00,
                'stok'       => 5,
                'deskripsi'  => 'Honda Vario 160 hadir dengan mesin 160cc SOHC 4 katup berpendingin cairan. Tampil modern dengan fitur keyless dan USB charger.',
                'gambar'     => '/assets/img/motors/vario160.jpg',
                'status'     => 'tersedia',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'merek_id'   => 1, 
                'nama_motor' => 'Honda Beat Deluxe',
                'tipe'       => 'matic',
                'tahun'      => '2024',
                'harga'      => 18750000.00,
                'stok'       => 8,
                'deskripsi'  => 'Honda Beat Deluxe lincah dan irit bahan bakar, cocok untuk mobilitas perkotaan harian.',
                'gambar'     => '/assets/img/motors/beat_deluxe.jpg',
                'status'     => 'tersedia',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('motors')->insertBatch($data);
    }
}
