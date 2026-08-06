<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penyewa::with('kamar');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhereHas('kamar', function($qk) use ($search) {
                      $qk->where('nomor_kamar', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Kamar
        if ($request->filled('kamars_id')) {
            $query->where('kamars_id', $request->kamars_id);
        }

        $penyewas = $query->latest()->paginate(5)->withQueryString();
        $kamarsList = Kamar::all();

        return view('penyewa.index', compact('penyewas', 'kamarsList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Hanya tampilkan kamar yang berstatus 'Tersedia' untuk penyewa baru,
        // namun jika ada kamar_id tertentu yang diminta, sertakan juga kamar tersebut.
        $kamarId = $request->query('kamar_id');
        $kamars = Kamar::where('status', 'Tersedia')
            ->when($kamarId, function($q) use ($kamarId) {
                $q->orWhere('id', $kamarId);
            })
            ->get();
        return view('penyewa.create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'pekerjaan' => 'required|string|max:255',
            'kamars_id' => 'required|exists:kamars,id',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        DB::transaction(function() use ($request) {
            // Buat data penyewa
            Penyewa::create($request->all());

            // Update status kamar menjadi 'Terisi'
            $kamar = Kamar::findOrFail($request->kamars_id);
            $kamar->update(['status' => 'Terisi']);
        });

        return redirect('/penyewa')->with('success', 'Penyewa berhasil ditambahkan dan status kamar diperbarui menjadi Terisi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewa $penyewa)
    {
        $penyewa->load(['kamar', 'pembayarans']);
        return view('penyewa.show', compact('penyewa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewa $penyewa)
    {
        // Tampilkan kamar yang sedang ditempati penyewa ini + kamar yang berstatus 'Tersedia'
        $kamars = Kamar::where('status', 'Tersedia')
                       ->orWhere('id', $penyewa->kamars_id)
                       ->get();
                       
        return view('penyewa.edit', compact('penyewa', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewa $penyewa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'pekerjaan' => 'required|string|max:255',
            'kamars_id' => 'required|exists:kamars,id',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        DB::transaction(function() use ($request, $penyewa) {
            $oldKamarId = $penyewa->kamars_id;
            $newKamarId = $request->kamars_id;

            // Update data penyewa
            $penyewa->update($request->all());

            // Jika pindah kamar
            if ($oldKamarId != $newKamarId) {
                // Set kamar lama menjadi 'Tersedia'
                $oldKamar = Kamar::findOrFail($oldKamarId);
                $oldKamar->update(['status' => 'Tersedia']);

                // Set kamar baru menjadi 'Terisi'
                $newKamar = Kamar::findOrFail($newKamarId);
                $newKamar->update(['status' => 'Terisi']);
            }
        });

        return redirect('/penyewa')->with('success', 'Data penyewa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        DB::transaction(function() use ($penyewa) {
            $kamarId = $penyewa->kamars_id;

            // Hapus penyewa
            $penyewa->delete();

            // Set kamar tersebut kembali menjadi 'Tersedia' jika tidak ada penyewa lain
            $kamar = Kamar::findOrFail($kamarId);
            $kamar->update(['status' => 'Tersedia']);
        });

        return redirect('/penyewa')->with('success', 'Penyewa berhasil dihapus dan status kamar kembali Tersedia.');
    }
}
