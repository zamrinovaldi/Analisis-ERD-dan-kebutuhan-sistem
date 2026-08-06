@extends('layouts.admin')

@section('title', 'Daftar Tamu')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Tamu</h1>
    <a href="{{ url('/penyewa/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Check-in Tamu
    </a>
</div>

<!-- Search & Filter Card -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" action="{{ url('/penyewa') }}" class="form-row align-items-center">
            <div class="col-md-5 my-1">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama tamu, email, no HP, atau no kamar..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 my-1">
                <select name="kamars_id" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Semua Kamar --</option>
                    @foreach($kamarsList as $kamar)
                        <option value="{{ $kamar->id }}" {{ request('kamars_id') == $kamar->id ? 'selected' : '' }}>
                            Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 my-1">
                <a href="{{ url('/penyewa') }}" class="btn btn-secondary btn-block">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Tamu Aktif</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Kamar</th>
                        <th>Periode Menginap</th>
                        <th>Durasi / Biaya</th>
                        <th>Pekerjaan</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyewas as $key => $penyewa)
                        <tr>
                            <td>{{ $penyewas->firstItem() + $key }}</td>
                            <td><strong>{{ $penyewa->nama }}</strong><br><small class="text-muted">{{ $penyewa->email }}</small></td>
                            <td>{{ $penyewa->no_hp }}</td>
                            <td>
                                @if($penyewa->kamar)
                                    <a href="{{ url('/kamar/' . $penyewa->kamar->id) }}" class="badge badge-info px-2 py-2">
                                        Kamar {{ $penyewa->kamar->nomor_kamar }}
                                    </a>
                                @else
                                    <span class="badge badge-secondary px-2 py-2">Belum Assign</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-success"><i class="fas fa-sign-in-alt mr-1"></i></span> {{ date('d/m/Y', strtotime($penyewa->tanggal_masuk)) }}<br>
                                <span class="text-danger"><i class="fas fa-sign-out-alt mr-1"></i></span> {{ date('d/m/Y', strtotime($penyewa->tanggal_keluar)) }}
                            </td>
                            <td>
                                <span class="badge badge-primary px-2 py-1">{{ $penyewa->durasi_menginap }} Malam</span><br>
                                <small class="text-success font-weight-bold">Rp {{ number_format($penyewa->total_biaya, 0, ',', '.') }}</small>
                            </td>
                            <td>
                                <a href="{{ url('/penyewa/' . $penyewa->id) }}" class="btn btn-info btn-sm" title="Detail & Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ url('/penyewa/' . $penyewa->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/penyewa/' . $penyewa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tamu ini? Kamar akan dikosongkan.')">
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
                            <td colspan="7" class="text-center text-muted">Data Tamu tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $penyewas->firstItem() ?? 0 }} sampai {{ $penyewas->lastItem() ?? 0 }} dari {{ $penyewas->total() }} data.
            </div>
            <div>
                {{ $penyewas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
