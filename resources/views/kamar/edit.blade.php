@extends('layouts.admin')

@section('title', 'Edit Kamar')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kamar: {{ $kamar->nomor_kamar }}</h1>
    <a href="{{ url('/kamar') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Kamar</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/kamar/' . $kamar->id) }}" method="POST">
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
                        <label for="nomor_kamar">Nomor Kamar <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_kamar" id="nomor_kamar" class="form-control @error('nomor_kamar') is-invalid @enderror" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" required>
                        @error('nomor_kamar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_kamar">Tipe Kamar <span class="text-danger">*</span></label>
                        <input type="text" name="tipe_kamar" id="tipe_kamar" class="form-control @error('tipe_kamar') is-invalid @enderror" value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}" required>
                        @error('tipe_kamar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga Sewa Bulanan (Rupiah) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $kamar->harga) }}" min="0" required>
                        </div>
                        @error('harga')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status Kamar <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="Tersedia" {{ old('status', $kamar->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Terisi" {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                            <option value="Pemeliharaan" {{ old('status', $kamar->status) == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">Perbarui Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
