@extends('layouts.admin')

@section('title', 'Daftar Kamar')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Kamar</h1>
    <a href="{{ url('/kamar/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kamar
    </a>
</div>

<!-- Search & Filter Card -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" action="{{ url('/kamar') }}" class="form-row align-items-center">
            <div class="col-md-4 my-1">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nomor/tipe kamar..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 my-1">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Semua Status --</option>
                    <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Terisi" {{ request('status') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="Pemeliharaan" {{ request('status') == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                </select>
            </div>

            <div class="col-md-3 my-1">
                <select name="tipe_kamar" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Semua Tipe --</option>
                    @foreach($tipeKamarList as $tipe)
                        <option value="{{ $tipe }}" {{ request('tipe_kamar') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 my-1">
                <a href="{{ url('/kamar') }}" class="btn btn-secondary btn-block">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kamars as $key => $kamar)
                        <tr>
                            <td>{{ $kamars->firstItem() + $key }}</td>
                            <td><strong>{{ $kamar->nomor_kamar }}</strong></td>
                            <td>{{ $kamar->tipe_kamar }}</td>
                            <td>Rp {{ number_format($kamar->harga, 0, ',', '.') }} / bulan</td>
                            <td>
                                @if($kamar->status == 'Tersedia')
                                    <span class="badge badge-success px-3 py-2">Tersedia</span>
                                @elseif($kamar->status == 'Terisi')
                                    <span class="badge badge-primary px-3 py-2">Terisi</span>
                                @else
                                    <span class="badge badge-warning px-3 py-2">Pemeliharaan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/kamar/' . $kamar->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('/kamar/' . $kamar->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/kamar/' . $kamar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data Kamar tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $kamars->firstItem() ?? 0 }} sampai {{ $kamars->lastItem() ?? 0 }} dari {{ $kamars->total() }} data.
            </div>
            <div>
                {{ $kamars->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
