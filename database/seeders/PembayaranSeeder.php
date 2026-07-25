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
            Pembayaran::create([
                'tanggal_bayar' => '2026-01-10',
                'jumlah' => 500000,
                'metode_pembayaran' => 'Tunai',
                'status' => 'Lunas',
                'penyewas_id' => $budi->id,
                'keterangan' => 'Pembayaran bulan Januari',
            ]);

            Pembayaran::create([
                'tanggal_bayar' => '2026-02-10',
                'jumlah' => 500000,
                'metode_pembayaran' => 'Transfer',
                'status' => 'Lunas',
                'penyewas_id' => $budi->id,
                'keterangan' => 'Pembayaran bulan Februari',
            ]);
        }

        if ($siti) {
            Pembayaran::create([
                'tanggal_bayar' => '2026-02-15',
                'jumlah' => 800000,
                'metode_pembayaran' => 'Transfer',
                'status' => 'Lunas',
                'penyewas_id' => $siti->id,
                'keterangan' => 'Pembayaran bulan Februari pertama masuk',
            ]);
        }
    }
}
