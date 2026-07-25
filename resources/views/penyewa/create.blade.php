@extends('layouts.admin')

@section('title', 'Check-in Tamu')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Check-in Tamu Baru</h1>
    <a href="{{ url('/penyewa') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Check-in Tamu</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/penyewa') }}" method="POST">
                    @csrf

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
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap..." required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no_hp">No. HP / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Contoh: 0812xxxxxxxx" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: tamu@email.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" placeholder="Contoh: Mahasiswa, Karyawan Swasta, PNS" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kamars_id">Pilih Kamar (Tersedia) <span class="text-danger">*</span></label>
                            <select name="kamars_id" id="kamars_id" class="form-control @error('kamars_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kamar --</option>
                                @forelse($kamars as $kamar)
                                    <option value="{{ $kamar->id }}" {{ old('kamars_id', request('kamar_id')) == $kamar->id ? 'selected' : '' }}>
                                        Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }} - Rp {{ number_format($kamar->harga, 0, ',', '.') }})
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada kamar tersedia. Harap tambahkan kamar baru dahulu.</option>
                                @endforelse
                            </select>
                            @error('kamars_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tanggal_masuk">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-3">Simpan Data & Set Kamar Terisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
