@extends('layouts.admin')

@section('title', 'Detail Kamar')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Kamar: {{ $kamar->nomor_kamar }}</h1>
    <a href="{{ url('/kamar') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <!-- Card Detail Kamar -->
    <div class="col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Kamar</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 150px;">Nomor Kamar</th>
                        <td>: <strong>{{ $kamar->nomor_kamar }}</strong></td>
                    </tr>
                    <tr>
                        <th>Tipe Kamar</th>
                        <td>: {{ $kamar->tipe_kamar }}</td>
                    </tr>
                    <tr>
                        <th>Harga Sewa</th>
                        <td>: Rp {{ number_format($kamar->harga, 0, ',', '.') }} / malam</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($kamar->status == 'Tersedia')
                                <span class="badge badge-success px-3 py-2">Tersedia</span>
                            @elseif($kamar->status == 'Terisi')
                                <span class="badge badge-primary px-3 py-2">Terisi</span>
                            @else
                                <span class="badge badge-warning px-3 py-2">Pemeliharaan</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Terdaftar Sejak</th>
                        <td>: {{ $kamar->created_at->format('d F Y') }}</td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/kamar/' . $kamar->id . '/edit') }}" class="btn btn-warning btn-sm btn-block mr-2">
                        <i class="fas fa-edit mr-1"></i> Edit Kamar
                    </a>
                    <form action="{{ url('/kamar/' . $kamar->id) }}" method="POST" class="btn-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-block">
                            <i class="fas fa-trash mr-1"></i> Hapus Kamar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Daftar Penyewa di Kamar Ini -->
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat/Daftar Tamu Kamar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Tamu</th>
                                <th>No. HP</th>
                                <th>Pekerjaan</th>
                                <th>Tanggal Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kamar->penyewas as $penyewa)
                                <tr>
                                    <td>
                                        <a href="{{ url('/penyewa/' . $penyewa->id) }}">
                                            <strong>{{ $penyewa->nama }}</strong>
                                        </a>
                                    </td>
                                    <td>{{ $penyewa->no_hp }}</td>
                                    <td>{{ $penyewa->pekerjaan }}</td>
                                    <td>{{ date('d M Y', strtotime($penyewa->tanggal_masuk)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada tamu yang menempati kamar ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
