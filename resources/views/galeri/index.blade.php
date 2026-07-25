@extends('layouts.admin')

@section('title', 'Galeri Gambar Hotel')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Galeri Foto Hotel & Kamar</h1>
</div>

<p class="text-muted mb-4">Halaman khusus untuk melihat seluruh visualisasi aset gambar Hotel 404 Not Found secara langsung dari browser Anda.</p>

<div class="row">
    <!-- Hotel Exterior -->
    <div class="col-xl-6 mb-4">
        <div class="card shadow border-0 overflow-hidden h-100">
            <div class="position-relative" style="height: 300px;">
                <img src="{{ asset('img/hotel.png') }}" class="card-img-top w-100 h-100" alt="Eksterior Hotel" style="object-fit: cover;">
                <span class="position-absolute badge badge-primary px-3 py-2" style="top: 15px; left: 15px; font-size: 0.85rem;">Bangunan Utama</span>
            </div>
            <div class="card-body p-4">
                <h4 class="font-weight-bold text-gray-900 mb-2">Eksterior Hotel 404 Not Found</h4>
                <p class="text-muted small">Visualisasi eksterior gedung dengan arsitektur modern minimalis industrial.</p>
                <div class="mt-3">
                    <a href="{{ asset('img/hotel.png') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-expand-alt"></i> Lihat Resolusi Penuh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Suite Room -->
    <div class="col-xl-6 mb-4">
        <div class="card shadow border-0 overflow-hidden h-100">
            <div class="position-relative" style="height: 300px;">
                <img src="{{ asset('img/suite.png') }}" class="card-img-top w-100 h-100" alt="Suite Room" style="object-fit: cover;">
                <span class="position-absolute badge badge-success px-3 py-2" style="top: 15px; left: 15px; font-size: 0.85rem;">Kamar Tipe Suite</span>
            </div>
            <div class="card-body p-4">
                <h4 class="font-weight-bold text-gray-900 mb-2">Interior Kamar Tipe Suite</h4>
                <p class="text-muted small">Kamar paling mewah dilengkapi dengan lounge keluarga dan pemandangan kota dari jendela kaca besar.</p>
                <div class="mt-3">
                    <a href="{{ asset('img/suite.png') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-expand-alt"></i> Lihat Resolusi Penuh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Deluxe Room -->
    <div class="col-xl-6 mb-4">
        <div class="card shadow border-0 overflow-hidden h-100">
            <div class="position-relative" style="height: 300px;">
                <img src="{{ asset('img/deluxe.png') }}" class="card-img-top w-100 h-100" alt="Deluxe Room" style="object-fit: cover;">
                <span class="position-absolute badge badge-info px-3 py-2" style="top: 15px; left: 15px; font-size: 0.85rem;">Kamar Tipe Deluxe</span>
            </div>
            <div class="card-body p-4">
                <h4 class="font-weight-bold text-gray-900 mb-2">Interior Kamar Tipe Deluxe</h4>
                <p class="text-muted small">Kamar premium dengan tempat tidur besar, kursi nyaman, dan akses pencahayaan alami yang indah.</p>
                <div class="mt-3">
                    <a href="{{ asset('img/deluxe.png') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-expand-alt"></i> Lihat Resolusi Penuh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Standard Room -->
    <div class="col-xl-6 mb-4">
        <div class="card shadow border-0 overflow-hidden h-100">
            <div class="position-relative" style="height: 300px;">
                <img src="{{ asset('img/standard.png') }}" class="card-img-top w-100 h-100" alt="Standard Room" style="object-fit: cover;">
                <span class="position-absolute badge badge-secondary px-3 py-2" style="top: 15px; left: 15px; font-size: 0.85rem;">Kamar Tipe Standard</span>
            </div>
            <div class="card-body p-4">
                <h4 class="font-weight-bold text-gray-900 mb-2">Interior Kamar Tipe Standard</h4>
                <p class="text-muted small">Kamar minimalis modern yang bersih, fungsional, dan sangat ideal untuk digital nomad atau solo traveler.</p>
                <div class="mt-3">
                    <a href="{{ asset('img/standard.png') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-expand-alt"></i> Lihat Resolusi Penuh
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
