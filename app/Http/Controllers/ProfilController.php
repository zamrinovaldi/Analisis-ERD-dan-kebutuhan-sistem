<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Tampilkan profil hotel.
     */
    public function index()
    {
        // Salin gambar hotel secara dinamis jika belum ada di public/img/hotel.png
        $targetDir = public_path('img');
        $targetFile = $targetDir . '/hotel.png';
        $sourceFile = 'C:/Users/ASUS/.gemini/antigravity-ide/brain/60f79904-c359-4414-8aff-14505bea6367/hotel_facade_1784956490377.png';

        if (!file_exists($targetFile)) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            if (file_exists($sourceFile)) {
                copy($sourceFile, $targetFile);
            }
        }

        // Data profil hotel
        $hotelInfo = [
            'nama' => 'Hotel 404 Not Found',
            'tagline' => 'Where Comfort Meets Seamless Experience',
            'deskripsi' => 'Hotel 404 Not Found adalah hotel butik modern berkonsep minimalis industrial yang dirancang khusus untuk memenuhi kebutuhan traveler masa kini, profesional bisnis, dan digital nomad. Kami menggabungkan kenyamanan luar biasa dengan layanan berbasis teknologi untuk memastikan pengalaman menginap Anda berjalan lancar tanpa hambatan.',
            'alamat' => 'Jl. Layar Utama No. 404, Kawasan Bisnis Cyber, Jakarta Selatan 12340',
            'telepon' => '+62 812-3456-7890',
            'email' => 'contact@hotel404notfound.com',
            'fasilitas' => [
                ['nama' => 'Kamar Smart Room Premium', 'icon' => 'fa-bed', 'deskripsi' => 'Kamar dengan AC, Smart TV 50", Coffee Maker, dan kasur kualitas bintang 5.'],
                ['nama' => 'Wi-Fi Super Cepat', 'icon' => 'fa-wifi', 'deskripsi' => 'Akses internet kecepatan tinggi hingga 100 Mbps gratis di seluruh area hotel.'],
                ['nama' => 'Co-Working Space', 'icon' => 'fa-laptop-house', 'deskripsi' => 'Ruang kerja bersama yang nyaman dan hening dilengkapi power outlet memadai.'],
                ['nama' => 'Rooftop Cafe & Lounge', 'icon' => 'fa-utensils', 'deskripsi' => 'Nikmati hidangan lezat dan kopi premium dengan pemandangan kota yang menakjubkan.'],
                ['nama' => 'Keamanan & Resepsionis 24 Jam', 'icon' => 'fa-shield-alt', 'deskripsi' => 'Layanan front desk 24 jam dan pantauan kamera CCTV untuk kenyamanan penuh Anda.'],
                ['nama' => 'Layanan Laundry Express', 'icon' => 'fa-tshirt', 'deskripsi' => 'Layanan pencucian pakaian cepat selesai agar hari Anda tetap produktif.']
            ],
            'visi' => 'Menjadi pelopor jaringan hotel butik pintar di Indonesia yang mengutamakan efisiensi layanan, kenyamanan huni, dan kemudahan akses bagi seluruh tamu.',
            'misi' => [
                'Menyediakan fasilitas akomodasi modern dengan standar kebersihan dan kenyamanan tertinggi.',
                'Mengintegrasikan teknologi informasi dalam proses operasional untuk pelayanan cepat tanpa kendala.',
                'Memberikan lingkungan yang mendukung bagi para tamu yang ingin tetap produktif saat bepergian (workcation).'
            ]
        ];

        return view('profil.index', compact('hotelInfo'));
    }
}
