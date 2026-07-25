@extends('layouts.admin')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Pembayaran</h1>
    <a href="{{ url('/pembayaran/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Catat Pembayaran
    </a>
</div>

<!-- Search & Filter Card -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" action="{{ url('/pembayaran') }}" class="form-row align-items-end">
            <div class="col-md-3 my-1">
                <label for="search">Cari Tamu/Metode</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Cari nama atau metode..." value="{{ request('search') }}">
            </div>
            
            <div class="col-md-2 my-1">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
            </div>

            <div class="col-md-2 my-1">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
            </div>

            <div class="col-md-2 my-1">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-- Semua --</option>
                    <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                </select>
            </div>

            <div class="col-md-3 my-1">
                <button type="submit" class="btn btn-primary mr-1">Filter</button>
                <a href="{{ url('/pembayaran') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Masuk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tamu</th>
                        <th>Kamar</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $key => $pembayaran)
                        <tr>
                            <td>{{ $pembayarans->firstItem() + $key }}</td>
                            <td>
                                @if($pembayaran->penyewa)
                                    <a href="{{ url('/penyewa/' . $pembayaran->penyewa->id) }}">
                                        <strong>{{ $pembayaran->penyewa->nama }}</strong>
                                    </a>
                                @else
                                    <span class="text-muted">Tamu Terhapus</span>
                                @endif
                            </td>
                            <td>
                                @if($pembayaran->penyewa && $pembayaran->penyewa->kamar)
                                    Kamar {{ $pembayaran->penyewa->kamar->nomor_kamar }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ date('d M Y', strtotime($pembayaran->tanggal_bayar)) }}</td>
                            <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $pembayaran->metode_pembayaran }}</td>
                            <td>
                                @if($pembayaran->status == 'Lunas')
                                    <span class="badge badge-success px-2 py-1">Lunas</span>
                                @elseif($pembayaran->status == 'Pending')
                                    <span class="badge badge-warning px-2 py-1">Pending</span>
                                @else
                                    <span class="badge badge-danger px-2 py-1">Gagal</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/pembayaran/' . $pembayaran->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('/pembayaran/' . $pembayaran->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/pembayaran/' . $pembayaran->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan pembayaran ini?')">
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
                            <td colspan="8" class="text-center text-muted">Data Pembayaran tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $pembayarans->firstItem() ?? 0 }} sampai {{ $pembayarans->lastItem() ?? 0 }} dari {{ $pembayarans->total() }} data.
            </div>
            <div>
                {{ $pembayarans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
