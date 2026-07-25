<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamars = [];

        // Generate 10 Standard Rooms (101 - 110)
        for ($i = 1; $i <= 10; $i++) {
            $nomor = '1' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $kamars[] = [
                'nomor_kamar' => $nomor,
                'tipe_kamar' => 'Standard',
                'harga' => 500000,
                'status' => ($nomor === '101') ? 'Terisi' : 'Tersedia',
            ];
        }

        // Generate 10 Deluxe Rooms (201 - 210)
        for ($i = 1; $i <= 10; $i++) {
            $nomor = '2' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $kamars[] = [
                'nomor_kamar' => $nomor,
                'tipe_kamar' => 'Deluxe',
                'harga' => 800000,
                'status' => ($nomor === '201') ? 'Terisi' : 'Tersedia',
            ];
        }

        // Generate 5 Suite Rooms (301 - 305)
        for ($i = 1; $i <= 5; $i++) {
            $nomor = '3' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $kamars[] = [
                'nomor_kamar' => $nomor,
                'tipe_kamar' => 'Suite',
                'harga' => 1500000,
                'status' => ($nomor === '301') ? 'Pemeliharaan' : 'Tersedia',
            ];
        }

        foreach ($kamars as $kamar) {
            Kamar::create($kamar);
        }
    }
}
