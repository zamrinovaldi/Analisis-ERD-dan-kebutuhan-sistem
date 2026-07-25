@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Statistik</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pendapatan (Lunas)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Rooms Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Kamar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKamar }} Kamar</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-door-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Rooms Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kamar Tersedia
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $kamarTersedia }} Kamar</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ $totalKamar > 0 ? ($kamarTersedia / $totalKamar) * 100 : 0 }}%" 
                                        aria-valuenow="{{ $kamarTersedia }}" aria-valuemin="0"
                                        aria-valuemax="{{ $totalKamar }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Occupied Rooms Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Kamar Terisi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kamarTerisi }} Kamar</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Payments Column -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">5 Transaksi Pembayaran Terakhir</h6>
                <a href="{{ url('/pembayaran') }}" class="btn btn-sm btn-link">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tamu</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPembayarans as $pembayaran)
                                <tr>
                                    <td>{{ $pembayaran->penyewa ? $pembayaran->penyewa->nama : 'Tamu Terhapus' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($pembayaran->tanggal_bayar)) }}</td>
                                    <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        @if($pembayaran->status == 'Lunas')
                                            <span class="badge badge-success">Lunas</span>
                                        @else
                                            <span class="badge badge-warning">{{ $pembayaran->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada transaksi pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tenants Column -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">5 Tamu Baru Check-in</h6>
                <a href="{{ url('/penyewa') }}" class="btn btn-sm btn-link">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kamar</th>
                                <th>Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPenyewas as $penyewa)
                                <tr>
                                    <td>{{ $penyewa->nama }}</td>
                                    <td>Kamar {{ $penyewa->kamar ? $penyewa->kamar->nomor_kamar : '-' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($penyewa->tanggal_masuk)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada data tamu.</td>
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


