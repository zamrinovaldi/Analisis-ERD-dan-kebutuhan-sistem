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
                                <option value="" data-harga="0">-- Pilih Kamar --</option>
                                @forelse($kamars as $kamar)
                                    <option value="{{ $kamar->id }}" data-harga="{{ $kamar->harga }}" data-info="Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }})" {{ old('kamars_id', request('kamar_id')) == $kamar->id ? 'selected' : '' }}>
                                        Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }} - Rp {{ number_format($kamar->harga, 0, ',', '.') }} / malam)
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada kamar tersedia. Harap tambahkan kamar baru dahulu.</option>
                                @endforelse
                            </select>
                            @error('kamars_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="tanggal_masuk">Tanggal Check-in <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="tanggal_keluar">Tanggal Check-out <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" value="{{ old('tanggal_keluar', date('Y-m-d', strtotime('+1 day'))) }}" required>
                            @error('tanggal_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Booking Summary Card -->
                    <div class="card border-left-primary bg-light mb-4" id="booking-summary-card" style="display: none;">
                        <div class="card-body py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary mb-2"><i class="fas fa-concierge-bell mr-2"></i>Ringkasan Reservasi</h6>
                                    <p class="mb-1 text-dark"><strong>Kamar:</strong> <span id="summary-room">-</span></p>
                                    <p class="mb-0 text-dark"><strong>Tarif:</strong> Rp <span id="summary-rate">0</span> / malam</p>
                                </div>
                                <div class="col-md-6 text-md-right mt-3 mt-md-0">
                                    <p class="mb-1 text-dark"><strong>Durasi Menginap:</strong> <span id="summary-duration" class="badge badge-primary px-2 py-1">1 Malam</span></p>
                                    <h5 class="mb-0 text-dark font-weight-bold">Estimasi Total: <span class="text-success font-weight-bold">Rp <span id="summary-total">0</span></span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-3">Simpan Data & Set Kamar Terisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const kamarSelect = $('#kamars_id');
        const checkinInput = $('#tanggal_masuk');
        const checkoutInput = $('#tanggal_keluar');
        const summaryCard = $('#booking-summary-card');
        const summaryRoom = $('#summary-room');
        const summaryRate = $('#summary-rate');
        const summaryDuration = $('#summary-duration');
        const summaryTotal = $('#summary-total');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function calculateSummary() {
            const selectedOption = kamarSelect.find('option:selected');
            const harga = parseInt(selectedOption.attr('data-harga')) || 0;
            const roomInfo = selectedOption.attr('data-info') || '';

            const checkinVal = checkinInput.val();
            const checkoutVal = checkoutInput.val();

            if (!checkinVal || !checkoutVal || !kamarSelect.val()) {
                summaryCard.slideUp();
                return;
            }

            const checkinDate = new Date(checkinVal);
            let checkoutDate = new Date(checkoutVal);

            // Jika tanggal checkout sebelum atau sama dengan tanggal checkin,
            // otomatis ubah checkout menjadi checkin + 1 hari
            if (checkoutDate <= checkinDate) {
                const nextDay = new Date(checkinDate);
                nextDay.setDate(nextDay.getDate() + 1);
                
                const yyyy = nextDay.getFullYear();
                let mm = nextDay.getMonth() + 1;
                let dd = nextDay.getDate();
                
                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;
                
                const nextDayStr = yyyy + '-' + mm + '-' + dd;
                checkoutInput.val(nextDayStr);
                checkoutDate = nextDay;
            }

            // Hitung durasi (dalam hari/malam)
            const diffTime = Math.abs(checkoutDate - checkinDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) || 1;

            const totalHarga = diffDays * harga;

            summaryRoom.text(roomInfo);
            summaryRate.text(formatRupiah(harga));
            summaryDuration.text(diffDays + ' Malam');
            summaryTotal.text(formatRupiah(totalHarga));
            
            summaryCard.slideDown();
        }

        kamarSelect.on('change', calculateSummary);
        checkinInput.on('change', calculateSummary);
        checkoutInput.on('change', calculateSummary);

        // Pemicu kalkulasi awal saat edit/preselect
        if (kamarSelect.val()) {
            calculateSummary();
        }
    });
</script>
@endsection
