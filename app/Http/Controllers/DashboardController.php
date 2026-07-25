<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'Tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'Terisi')->count();
        $kamarMaintenance = Kamar::where('status', 'Pemeliharaan')->count();

        $totalPenyewa = Penyewa::count();
        
        // Pendapatan kumulatif dari pembayaran berstatus 'Lunas'
        $totalPendapatan = Pembayaran::where('status', 'Lunas')->sum('jumlah');

        // Pendapatan bulanan untuk tahun berjalan (Kompatibel 100% MySQL & SQLite)
        $pembayaransCurrentYear = Pembayaran::where('status', 'Lunas')
            ->whereYear('tanggal_bayar', date('Y'))
            ->get();

        $pendapatanBulanan = [];
        foreach ($pembayaransCurrentYear as $p) {
            if ($p->tanggal_bayar) {
                $m = (int) date('n', strtotime($p->tanggal_bayar));
                $pendapatanBulanan[$m] = ($pendapatanBulanan[$m] ?? 0) + (int) $p->jumlah;
            }
        }

        // Siapkan array data 12 bulan (akumulatif/kumulatif)
        $chartMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $chartRevenue = [];
        $runningTotal = 0;
        for ($m = 1; $m <= 12; $m++) {
            $runningTotal += (int) ($pendapatanBulanan[$m] ?? 0);
            $chartRevenue[] = $runningTotal;
        }

        // 5 transaksi pembayaran terbaru
        $recentPembayarans = Pembayaran::with('penyewa')
            ->latest('tanggal_bayar')
            ->take(5)
            ->get();

        // 5 penyewa terbaru masuk
        $recentPenyewas = Penyewa::with('kamar')
            ->latest('tanggal_masuk')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'kamarMaintenance',
            'totalPenyewa',
            'totalPendapatan',
            'recentPembayarans',
            'recentPenyewas',
            'chartMonths',
            'chartRevenue'
        ));
    }
}
