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
                ['penyewas_id' => $budi->id, 'keterangan' => 'Pembayaran bulan Januari'],
                [
                    'tanggal_bayar' => '2026-01-10',
                    'jumlah' => 500000,
                    'metode_pembayaran' => 'Tunai',
                    'status' => 'Lunas',
                ]
            );

            Pembayaran::updateOrCreate(
                ['penyewas_id' => $budi->id, 'keterangan' => 'Pembayaran bulan Februari'],
                [
                    'tanggal_bayar' => '2026-02-10',
                    'jumlah' => 500000,
                    'metode_pembayaran' => 'Transfer',
                    'status' => 'Lunas',
                ]
            );
        }

        if ($siti) {
            Pembayaran::updateOrCreate(
                ['penyewas_id' => $siti->id, 'keterangan' => 'Pembayaran bulan Februari pertama masuk'],
                [
                    'tanggal_bayar' => '2026-02-15',
                    'jumlah' => 800000,
                    'metode_pembayaran' => 'Transfer',
                    'status' => 'Lunas',
                ]
            );
        }
    }
}
