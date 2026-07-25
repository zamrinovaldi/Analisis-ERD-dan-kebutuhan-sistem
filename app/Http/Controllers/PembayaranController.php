<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pembayaran::with('penyewa.kamar');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                  ->orWhere('metode_pembayaran', 'like', "%{$search}%")
                  ->orWhereHas('penyewa', function($qp) use ($search) {
                      $qp->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Rentang Tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_bayar', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        // Filter Status Pembayaran
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pembayarans = $query->latest('tanggal_bayar')->paginate(5)->withQueryString();

        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $penyewas = Penyewa::with('kamar')->get();
        $selectedPenyewaId = $request->query('penyewas_id');

        return view('pembayaran.create', compact('penyewas', 'selectedPenyewaId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penyewas_id' => 'required|exists:penyewas,id',
            'tanggal_bayar' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string|max:255',
            'status' => 'required|string|in:Lunas,Pending,Gagal',
            'keterangan' => 'nullable|string',
        ]);

        Pembayaran::create($request->all());

        return redirect('/pembayaran')->with('success', 'Transaksi pembayaran berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('penyewa.kamar');
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $penyewas = Penyewa::all();
        return view('pembayaran.edit', compact('pembayaran', 'penyewas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'penyewas_id' => 'required|exists:penyewas,id',
            'tanggal_bayar' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string|max:255',
            'status' => 'required|string|in:Lunas,Pending,Gagal',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($request->all());

        return redirect('/pembayaran')->with('success', 'Transaksi pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect('/pembayaran')->with('success', 'Transaksi pembayaran berhasil dihapus.');
    }
}
