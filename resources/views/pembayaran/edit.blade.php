@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Transaksi Pembayaran</h1>
    <a href="{{ url('/pembayaran') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Transaksi</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/pembayaran/' . $pembayaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="penyewas_id">Tamu <span class="text-danger">*</span></label>
                        <select name="penyewas_id" id="penyewas_id" class="form-control" required>
                            @foreach($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}" {{ old('penyewas_id', $pembayaran->penyewas_id) == $penyewa->id ? 'selected' : '' }}>
                                    {{ $penyewa->nama }} (Kamar {{ $penyewa->kamar ? $penyewa->kamar->nomor_kamar : '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_bayar">Tanggal Bayar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="jumlah">Jumlah Pembayaran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $pembayaran->jumlah) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                <option value="Transfer" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="Tunai" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="Lunas" {{ old('status', $pembayaran->status) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Pending" {{ old('status', $pembayaran->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Gagal" {{ old('status', $pembayaran->status) == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">Perbarui Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
