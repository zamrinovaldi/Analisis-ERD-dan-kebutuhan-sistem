@extends('layouts.admin')

@section('title', 'Catat Pembayaran')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Catat Transaksi Pembayaran</h1>
    <a href="{{ url('/pembayaran') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Kuitansi Pembayaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/pembayaran') }}" method="POST">
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
                        <label for="penyewas_id">Pilih Tamu <span class="text-danger">*</span></label>
                        <select name="penyewas_id" id="penyewas_id" class="form-control @error('penyewas_id') is-invalid @enderror" required>
                            <option value="" data-biaya="0">-- Pilih Tamu --</option>
                            @foreach($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}" data-biaya="{{ $penyewa->total_biaya }}" {{ (old('penyewas_id', $selectedPenyewaId) == $penyewa->id) ? 'selected' : '' }}>
                                    {{ $penyewa->nama }} (Kamar {{ $penyewa->kamar ? $penyewa->kamar->nomor_kamar : '-' }} - {{ $penyewa->durasi_menginap }} Malam - Total Tarif: Rp {{ number_format($penyewa->total_biaya, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('penyewas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_bayar">Tanggal Bayar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                            @error('tanggal_bayar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="jumlah">Jumlah Pembayaran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Contoh: 500000" min="0" required>
                            </div>
                            @error('jumlah')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror" required>
                                <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="Tunai" {{ old('metode_pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            </select>
                            @error('metode_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Lunas" {{ old('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Gagal" {{ old('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Contoh: Pembayaran Sewa Tamu Mandiri">{{ old('keterangan') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const tamuSelect = $('#penyewas_id');
        const jumlahInput = $('#jumlah');
        const keteranganInput = $('#keterangan');

        function autofillPayment() {
            const selectedOption = tamuSelect.find('option:selected');
            const totalBiaya = parseInt(selectedOption.attr('data-biaya')) || 0;
            const textInfo = selectedOption.text().trim();

            if (tamuSelect.val() && totalBiaya > 0) {
                // Prefill jumlah
                jumlahInput.val(totalBiaya);
                
                // Set default keterangan jika kosong
                if (keteranganInput.val() === '') {
                    keteranganInput.val('Pembayaran Lunas untuk ' + textInfo.split('(')[0].trim());
                }
            } else {
                jumlahInput.val('');
            }
        }

        tamuSelect.on('change', autofillPayment);

        // Pemicu awal jika ada pre-selected tamu
        if (tamuSelect.val()) {
            autofillPayment();
        }
    });
</script>
@endsection
