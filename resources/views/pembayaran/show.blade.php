@extends('layouts.admin')

@section('title', 'Kuitansi Pembayaran')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
    <h1 class="h3 mb-0 text-gray-800">Kuitansi Pembayaran</h1>
    <div>
        <a href="{{ url('/pembayaran') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-sm btn-primary shadow-sm ml-2">
            <i class="fas fa-print fa-sm text-white-50"></i> Cetak Kuitansi
        </button>
    </div>
</div>

<!-- Invoice Card -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container-fluid">
            <!-- Header Kuitansi -->
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h3 class="font-weight-bold text-primary mb-1"><i class="fas fa-hotel mr-2"></i>Hotel 404 Not Found</h3>
                    <p class="text-muted mb-0">Sistem Manajemen Hotel Modern</p>
                </div>
                <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                    <h5 class="font-weight-bold text-gray-800">KUITANSI PEMBAYARAN</h5>
                    <p class="text-muted mb-0">ID Transaksi: #TRX-{{ str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-muted">Tanggal: {{ date('d F Y', strtotime($pembayaran->tanggal_bayar)) }}</p>
                </div>
            </div>

            <hr>

            <!-- Rincian Penyewa -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted font-weight-bold">Diterima Dari:</h6>
                    <h5 class="font-weight-bold text-gray-900 mb-1">{{ $pembayaran->penyewa ? $pembayaran->penyewa->nama : 'Penyewa Terhapus' }}</h5>
                    <p class="text-muted mb-0">No. HP: {{ $pembayaran->penyewa ? $pembayaran->penyewa->no_hp : '-' }}</p>
                    <p class="text-muted">Email: {{ $pembayaran->penyewa ? $pembayaran->penyewa->email : '-' }}</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <h6 class="text-muted font-weight-bold">Kamar Yang Dihuni:</h6>
                    @if($pembayaran->penyewa && $pembayaran->penyewa->kamar)
                        <h5 class="font-weight-bold text-gray-900 mb-1">Kamar {{ $pembayaran->penyewa->kamar->nomor_kamar }}</h5>
                        <p class="text-muted">Tipe Kamar: {{ $pembayaran->penyewa->kamar->tipe_kamar }}</p>
                    @else
                        <h5 class="font-weight-bold text-muted mb-1">-</h5>
                    @endif
                </div>
            </div>

            <!-- Detail Pembayaran Table -->
            <div class="table-responsive my-4">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light">
                            <th>Deskripsi Pembayaran</th>
                            <th class="text-right" style="width: 250px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Biaya Sewa Kamar</strong><br>
                                <span class="text-muted">{{ $pembayaran->keterangan ?? 'Pembayaran sewa kamar kost berkala' }}</span>
                            </td>
                            <td class="text-right font-weight-bold text-gray-900">
                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-weight-bold text-gray-900 bg-light">Jumlah Total:</td>
                            <td class="text-right font-weight-bold text-primary bg-light" style="font-size: 1.2rem;">
                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Informasi Tambahan -->
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted mb-1"><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode_pembayaran }}</p>
                    <p class="text-muted">
                        <strong>Status: </strong>
                        @if($pembayaran->status == 'Lunas')
                            <span class="badge badge-success px-2 py-1">Lunas</span>
                        @elseif($pembayaran->status == 'Pending')
                            <span class="badge badge-warning px-2 py-1">Pending</span>
                        @else
                            <span class="badge badge-danger px-2 py-1">Gagal</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right mt-4 mt-md-0" style="min-height: 120px;">
                    <p class="text-muted mb-5">Hormat Kami,</p>
                    <h6 class="font-weight-bold text-gray-900 mt-5 mb-0">Hotel 404 Not Found Admin</h6>
                    <small class="text-muted">Tanda tangan elektronik sah secara sistem</small>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
@media print {
    .no-print, .sidebar, .topbar, .sticky-footer, .scroll-to-top {
        display: none !important;
    }
    #content-wrapper {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection
