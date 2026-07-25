@extends('layouts.admin')

@section('title', 'Detail Tamu')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Tamu: {{ $penyewa->nama }}</h1>
    <a href="{{ url('/penyewa') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <!-- Card Detail Penyewa -->
    <div class="col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pribadi & Kamar</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 130px;">Nama</th>
                        <td>: <strong>{{ $penyewa->nama }}</strong></td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>: {{ $penyewa->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $penyewa->email }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan</th>
                        <td>: {{ $penyewa->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>: {{ date('d F Y', strtotime($penyewa->tanggal_masuk)) }}</td>
                    </tr>
                    <tr>
                        <th>Kamar Ditempati</th>
                        <td>: 
                            @if($penyewa->kamar)
                                <a href="{{ url('/kamar/' . $penyewa->kamar->id) }}" class="badge badge-info px-2 py-2">
                                    Kamar {{ $penyewa->kamar->nomor_kamar }} ({{ $penyewa->kamar->tipe_kamar }})
                                </a>
                            @else
                                <span class="badge badge-secondary px-2 py-2">Tidak Ada Kamar</span>
                            @endif
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/penyewa/' . $penyewa->id . '/edit') }}" class="btn btn-warning btn-sm btn-block mr-2">
                        <i class="fas fa-edit mr-1"></i> Edit Data
                    </a>
                    <form action="{{ url('/penyewa/' . $penyewa->id) }}" method="POST" class="btn-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tamu ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-block">
                            <i class="fas fa-trash mr-1"></i> Hapus Tamu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Riwayat Pembayaran -->
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Pembayaran</h6>
                <a href="{{ url('/pembayaran/create?penyewas_id=' . $penyewa->id) }}" class="btn btn-xs btn-primary shadow-sm btn-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Transaksi
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penyewa->pembayarans as $pembayaran)
                                <tr>
                                    <td>{{ date('d M Y', strtotime($pembayaran->tanggal_bayar)) }}</td>
                                    <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $pembayaran->metode_pembayaran }}</td>
                                    <td>
                                        @if($pembayaran->status == 'Lunas')
                                            <span class="badge badge-success">Lunas</span>
                                        @elseif($pembayaran->status == 'Pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Gagal</span>
                                        @endif
                                    </td>
                                    <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada riwayat transaksi pembayaran.</td>
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
