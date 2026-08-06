<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budi = Penyewa::where('nama', 'Budi Santoso')->first();
        $siti = Penyewa::where('nama', 'Siti Aminah')->first();

        if ($budi) {
            Pembayaran::updateOrCreate(
                ['penyewas_id' => $budi->id, 'keterangan' => 'Pembayaran Sewa Kamar 101 (2 Malam)'],
                [
                    'tanggal_bayar' => '2026-01-10',
                    'jumlah' => 1000000,
                    'metode_pembayaran' => 'Transfer',
                    'status' => 'Lunas',
                ]
            );
        }

        if ($siti) {
            Pembayaran::updateOrCreate(
                ['penyewas_id' => $siti->id, 'keterangan' => 'Pembayaran Sewa Kamar 201 (2 Malam)'],
                [
                    'tanggal_bayar' => '2026-02-15',
                    'jumlah' => 1600000,
                    'metode_pembayaran' => 'Transfer',
                    'status' => 'Lunas',
                ]
            );
        }
    }
}
