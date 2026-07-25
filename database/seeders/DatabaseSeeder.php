<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat User Admin dengan kredensial rahasia baru
        User::updateOrCreate(
            ['email' => 'admin@hotel404.com'],
            [
                'name' => 'adminhotel',
                'password' => bcrypt('Hotel404#2026'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@hotel404.com'],
            [
                'name' => 'ownerhotel',
                'password' => bcrypt('Hotel404#2026'),
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@hotel404.com'],
            [
                'name' => 'staffhotel',
                'password' => bcrypt('Hotel404#2026'),
                'role' => 'staff',
            ]
        );

        // Jalankan seeder lainnya
        $this->call([
            KamarSeeder::class,
            PenyewaSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
