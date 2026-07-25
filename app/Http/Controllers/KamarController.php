<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Kamar::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_kamar', 'like', "%{$search}%")
                  ->orWhere('tipe_kamar', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tipe
        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }

        $kamars = $query->orderBy('nomor_kamar', 'asc')->paginate(5)->withQueryString();
        
        // Get unique tipe_kamar for filter dropdown
        $tipeKamarList = Kamar::select('tipe_kamar')->distinct()->pluck('tipe_kamar');

        return view('kamar.index', compact('kamars', 'tipeKamarList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar',
            'tipe_kamar' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|string|in:Tersedia,Terisi,Pemeliharaan',
        ]);

        Kamar::create($request->all());

        return redirect('/kamar')->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar,' . $kamar->id,
            'tipe_kamar' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|string|in:Tersedia,Terisi,Pemeliharaan',
        ]);

        $kamar->update($request->all());

        return redirect('/kamar')->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect('/kamar')->with('success', 'Kamar berhasil dihapus.');
    }
}
