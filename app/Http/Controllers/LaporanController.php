<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Kamar;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display financial and room occupancy reports.
     */
    public function index(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', date('Y-m-01')); // Default to 1st of current month
        $tanggalSelesai = $request->input('tanggal_selesai', date('Y-m-d')); // Default to today

        // Query transaksi pembayaran dalam rentang tanggal
        $pembayarans = Pembayaran::with('penyewa.kamar')
            ->whereBetween('tanggal_bayar', [$tanggalMulai, $tanggalSelesai])
            ->latest('tanggal_bayar')
            ->get();

        // Hitung total ringkasan
        $totalPendapatan = $pembayarans->where('status', 'Lunas')->sum('jumlah');
        $totalPending = $pembayarans->where('status', 'Pending')->sum('jumlah');
        $totalGagal = $pembayarans->where('status', 'Gagal')->sum('jumlah');
        
        // Status occupancy kamar saat ini
        $kamarStats = [
            'total' => Kamar::count(),
            'tersedia' => Kamar::where('status', 'Tersedia')->count(),
            'terisi' => Kamar::where('status', 'Terisi')->count(),
            'maintenance' => Kamar::where('status', 'Pemeliharaan')->count(),
        ];

        return view('laporan.index', compact(
            'pembayarans',
            'tanggalMulai',
            'tanggalSelesai',
            'totalPendapatan',
            'totalPending',
            'totalGagal',
            'kamarStats'
        ));
    }
}
