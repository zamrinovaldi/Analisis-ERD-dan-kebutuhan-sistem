<?php

namespace Database\Seeders;

use App\Models\Kamar;
use App\Models\Penyewa;
use Illuminate\Database\Seeder;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamar101 = Kamar::where('nomor_kamar', '101')->first();
        $kamar201 = Kamar::where('nomor_kamar', '201')->first();

        if ($kamar101) {
            Penyewa::create([
                'nama' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'email' => 'budi@example.com',
                'pekerjaan' => 'Mahasiswa',
                'kamars_id' => $kamar101->id,
                'tanggal_masuk' => '2026-01-10',
            ]);
        }

        if ($kamar201) {
            Penyewa::create([
                'nama' => 'Siti Aminah',
                'no_hp' => '089876543210',
                'email' => 'siti@example.com',
                'pekerjaan' => 'Karyawan Swasta',
                'kamars_id' => $kamar201->id,
                'tanggal_masuk' => '2026-02-15',
            ]);
        }
    }
}
