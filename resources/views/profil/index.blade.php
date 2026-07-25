@extends('layouts.admin')

@section('title', 'Profil Hotel')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Hotel</h1>
</div>

<div class="row">
    <!-- Hotel Main Card -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow border-0 overflow-hidden">
            <div class="row no-gutters">
                <div class="col-xl-6 col-lg-5">
                    <div class="position-relative h-100 min-vh-50" style="min-height: 380px;">
                        <img src="{{ asset('img/hotel.png') }}" class="w-100 h-100 object-fit-cover position-absolute" alt="Hotel 404 Not Found" style="object-fit: cover; top: 0; left: 0;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <div class="card-body p-5">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Boutique & Smart Hotel</div>
                        <h2 class="h2 font-weight-bold text-gray-900 mb-2">{{ $hotelInfo['nama'] }}</h2>
                        <p class="text-muted font-italic mb-4">"{{ $hotelInfo['tagline'] }}"</p>
                        
                        <hr class="my-4">
                        
                        <p class="text-gray-700 leading-relaxed mb-4">
                            {{ $hotelInfo['deskripsi'] }}
                        </p>
                        
                        <div class="mt-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="icon-circle bg-primary-light text-primary mr-3 mt-1" style="min-width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background-color: rgba(78, 115, 223, 0.1);">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <span class="d-block font-weight-bold text-gray-900">Alamat</span>
                                    <span class="text-muted text-sm">{{ $hotelInfo['alamat'] }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-3">
                                <div class="icon-circle bg-success-light text-success mr-3 mt-1" style="min-width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background-color: rgba(28, 200, 138, 0.1);">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <span class="d-block font-weight-bold text-gray-900">Telepon & WhatsApp</span>
                                    <span class="text-muted text-sm">{{ $hotelInfo['telepon'] }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <div class="icon-circle bg-info-light text-info mr-3 mt-1" style="min-width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background-color: rgba(54, 185, 204, 0.1);">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <span class="d-block font-weight-bold text-gray-900">Email</span>
                                    <span class="text-muted text-sm">{{ $hotelInfo['email'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Visi & Misi Row -->
<div class="row mb-4">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="card shadow border-0 h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-eye text-primary fa-2x mr-3"></i>
                    <h4 class="m-0 font-weight-bold text-gray-900">Visi Kami</h4>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    {{ $hotelInfo['visi'] }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow border-0 h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-bullseye text-success fa-2x mr-3"></i>
                    <h4 class="m-0 font-weight-bold text-gray-900">Misi Kami</h4>
                </div>
                <ul class="list-unstyled pl-0 text-gray-700">
                    @foreach($hotelInfo['misi'] as $misi)
                        <li class="d-flex align-items-start mb-2">
                            <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                            <span>{{ $misi }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Facilities Section -->
<div class="row">
    <div class="col-12">
        <h4 class="h4 font-weight-bold text-gray-800 mb-3">Fasilitas Utama</h4>
    </div>
    
    @foreach($hotelInfo['fasilitas'] as $facility)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 border-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ $facility['nama'] }}
                            </div>
                            <div class="text-muted text-xs leading-normal">
                                {{ $facility['deskripsi'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas {{ $facility['icon'] }} fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
