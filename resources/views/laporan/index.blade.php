@extends('layouts.admin')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
    <h1 class="h3 mb-0 text-gray-800">Laporan Keuangan & Okupansi</h1>
    <button onclick="window.print()" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
    </button>
</div>

<!-- Filter Card (no-print) -->
<div class="card shadow mb-4 no-print">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Periode Laporan</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ url('/laporan') }}" class="form-row align-items-end">
            <div class="form-group col-md-4 mb-0">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}" required>
            </div>
            <div class="form-group col-md-4 mb-0">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ $tanggalSelesai }}" required>
            </div>
            <div class="form-group col-md-4 mb-0">
                <button type="submit" class="btn btn-primary mr-1">Tampilkan</button>
                <a href="{{ url('/laporan') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Print Header (Hanya muncul saat cetak) -->
<div class="print-only mb-4 text-center">
    <h2 class="font-weight-bold mb-1"><i class="fas fa-hotel mr-2"></i>Hotel 404 Not Found</h2>
    <h4>LAPORAN KEUANGAN & TRANSAKSI PEMBAYARAN</h4>
    <p class="text-muted">Periode: {{ date('d F Y', strtotime($tanggalMulai)) }} s/d {{ date('d F Y', strtotime($tanggalSelesai)) }}</p>
    <hr style="border-top: 3px double #8c8b8b;">
</div>

<!-- Summary Cards Row -->
<div class="row mb-4">
    <!-- Earning Card -->
    <div class="col-md-4 mb-3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pendapatan Bersih (Lunas)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Card -->
    <div class="col-md-4 mb-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPending, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Failed Card -->
    <div class="col-md-4 mb-3">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Gagal</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalGagal, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Rincian Transaksi Masuk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tanggal Bayar</th>
                        <th>Tamu</th>
                        <th>Kamar</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $key => $pembayaran)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ date('d M Y', strtotime($pembayaran->tanggal_bayar)) }}</td>
                            <td><strong>{{ $pembayaran->penyewa ? $pembayaran->penyewa->nama : 'Tamu Terhapus' }}</strong></td>
                            <td>{{ $pembayaran->penyewa && $pembayaran->penyewa->kamar ? 'Kamar ' . $pembayaran->penyewa->kamar->nomor_kamar : '-' }}</td>
                            <td>{{ $pembayaran->metode_pembayaran }}</td>
                            <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                            <td>
                                @if($pembayaran->status == 'Lunas')
                                    <span class="badge badge-success px-2 py-1">Lunas</span>
                                @elseif($pembayaran->status == 'Pending')
                                    <span class="badge badge-warning px-2 py-1">Pending</span>
                                @else
                                    <span class="badge badge-danger px-2 py-1">Gagal</span>
                                @endif
                            </td>
                            <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada transaksi pembayaran pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Status Okupansi Kamar Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Status Okupansi Kamar Hotel Saat Ini</h6>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-3 border-right">
                <h5 class="text-muted font-weight-bold">Total Kamar</h5>
                <h2 class="font-weight-bold text-primary">{{ $kamarStats['total'] }}</h2>
            </div>
            <div class="col-md-3 border-right">
                <h5 class="text-muted font-weight-bold">Kamar Terisi</h5>
                <h2 class="font-weight-bold text-warning">{{ $kamarStats['terisi'] }}</h2>
            </div>
            <div class="col-md-3 border-right">
                <h5 class="text-muted font-weight-bold">Kamar Tersedia</h5>
                <h2 class="font-weight-bold text-success">{{ $kamarStats['tersedia'] }}</h2>
            </div>
            <div class="col-md-3">
                <h5 class="text-muted font-weight-bold">Pemeliharaan</h5>
                <h2 class="font-weight-bold text-secondary">{{ $kamarStats['maintenance'] }}</h2>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS khusus cetak/print laporan */
.print-only {
    display: none;
}
@media print {
    .no-print, .sidebar, .topbar, .sticky-footer, .scroll-to-top {
        display: none !important;
    }
    .print-only {
        display: block !important;
    }
    #content-wrapper {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        background-color: transparent !important;
        border-bottom: 2px solid #333 !important;
        padding-left: 0 !important;
    }
    table {
        border: 1px solid #333 !important;
    }
    th {
        background-color: #f2f2f2 !important;
        color: #000 !important;
        border: 1px solid #333 !important;
    }
    td {
        border: 1px solid #333 !important;
    }
}
</style>
@endsection
