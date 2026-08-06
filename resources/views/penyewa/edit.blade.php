@extends('layouts.admin')

@section('title', 'Edit Tamu')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Tamu: {{ $penyewa->nama }}</h1>
    <a href="{{ url('/penyewa') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Tamu</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/penyewa/' . $penyewa->id) }}" method="POST">
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
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $penyewa->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no_hp">No. HP / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $penyewa->no_hp) }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $penyewa->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan', $penyewa->pekerjaan) }}" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kamars_id">Pilih Kamar (Tersedia) <span class="text-danger">*</span></label>
                            <select name="kamars_id" id="kamars_id" class="form-control @error('kamars_id') is-invalid @enderror" required>
                                @foreach($kamars as $kamar)
                                    <option value="{{ $kamar->id }}" data-harga="{{ $kamar->harga }}" data-info="Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }})" {{ old('kamars_id', $penyewa->kamars_id) == $kamar->id ? 'selected' : '' }}>
                                        Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }} - Rp {{ number_format($kamar->harga, 0, ',', '.') }} / malam)
                                        @if($kamar->id == $penyewa->kamars_id) (Kamar Saat Ini) @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('kamars_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="tanggal_masuk">Tanggal Check-in <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', $penyewa->tanggal_masuk) }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="tanggal_keluar">Tanggal Check-out <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" value="{{ old('tanggal_keluar', $penyewa->tanggal_keluar) }}" required>
                            @error('tanggal_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Booking Summary Card -->
                    <div class="card border-left-warning bg-light mb-4" id="booking-summary-card" style="display: none;">
                        <div class="card-body py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-warning mb-2"><i class="fas fa-concierge-bell mr-2"></i>Ringkasan Perubahan Reservasi</h6>
                                    <p class="mb-1 text-dark"><strong>Kamar:</strong> <span id="summary-room">-</span></p>
                                    <p class="mb-0 text-dark"><strong>Tarif:</strong> Rp <span id="summary-rate">0</span> / malam</p>
                                </div>
                                <div class="col-md-6 text-md-right mt-3 mt-md-0">
                                    <p class="mb-1 text-dark"><strong>Durasi Menginap:</strong> <span id="summary-duration" class="badge badge-warning px-2 py-1">1 Malam</span></p>
                                    <h5 class="mb-0 text-dark font-weight-bold">Estimasi Total: <span class="text-success font-weight-bold">Rp <span id="summary-total">0</span></span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block mt-3">Perbarui Data & Update Status Kamar</button>
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

        let lastMasuk = '';
        let lastKeluar = '';

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function calculateSummaryOnly() {
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
            const checkoutDate = new Date(checkoutVal);

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

        function fetchAvailableRooms() {
            const checkinVal = checkinInput.val();
            const checkoutVal = checkoutInput.val();

            if (!checkinVal || !checkoutVal) return;

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

            const currentMasuk = checkinInput.val();
            const currentKeluar = checkoutInput.val();

            if (currentMasuk === lastMasuk && currentKeluar === lastKeluar) {
                calculateSummaryOnly();
                return;
            }

            lastMasuk = currentMasuk;
            lastKeluar = currentKeluar;

            const prevSelected = kamarSelect.val();

            $.ajax({
                url: "{{ url('/penyewa/kamar-tersedia') }}",
                type: 'GET',
                data: {
                    tanggal_masuk: currentMasuk,
                    tanggal_keluar: currentKeluar
                    @if(isset($penyewa))
                    , exclude_penyewa_id: {{ $penyewa->id }}
                    @endif
                },
                success: function(rooms) {
                    // Kosongkan select kecuali option pertama
                    kamarSelect.find('option:not(:first)').remove();

                    if (rooms.length === 0) {
                        kamarSelect.append('<option value="" disabled>Tidak ada kamar tersedia pada tanggal ini</option>');
                    } else {
                        rooms.forEach(function(room) {
                            const formattedHarga = new Intl.NumberFormat('id-ID').format(room.harga);
                            const option = $('<option></option>')
                                .val(room.id)
                                .attr('data-harga', room.harga)
                                .attr('data-info', 'Kamar ' + room.nomor_kamar + ' (' + room.tipe_kamar + ')')
                                .text('Kamar ' + room.nomor_kamar + ' (' + room.tipe_kamar + ' - Rp ' + formattedHarga + ' / malam)');
                            kamarSelect.append(option);
                        });
                    }

                    // Kembalikan pilihan jika masih tersedia di data baru
                    if (prevSelected) {
                        kamarSelect.val(prevSelected);
                    }
                    
                    calculateSummaryOnly();
                }
            });
        }

        kamarSelect.on('change', calculateSummaryOnly);
        checkinInput.on('change', fetchAvailableRooms);
        checkoutInput.on('change', fetchAvailableRooms);

        // Pemicu pencarian awal untuk tanggal checkin/checkout default
        fetchAvailableRooms();
    });
</script>
@endsection
