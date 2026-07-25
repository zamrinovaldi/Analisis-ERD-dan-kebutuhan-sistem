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
        // Buat User dengan role berbeda (Password diset 'admin' untuk semua)
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Hotel',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@admin.com'],
            [
                'name' => 'Owner Hotel',
                'password' => bcrypt('admin'),
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@admin.com'],
            [
                'name' => 'Staff Hotel',
                'password' => bcrypt('admin'),
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
