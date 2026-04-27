<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Kategori
        $seminar = \App\Models\Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $entertainment = \App\Models\Category::create([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);

        $workshop = \App\Models\Category::create([
            'name' => 'Workshop',
            'slug' => 'workshop',
        ]);

        // Events
        \App\Models\Event::create([
            'category_id' => $seminar->id,
            'title' => 'AI Summit & Expo 2026',
            'description' => 'Jelajahi tren AI terbaru.',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Ruang Cinema',
            'price' => 45000,
            'stock' => 150,
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $seminar->id,
            'title' => 'Cyber Security Talk',
            'description' => 'Belajar keamanan digital.',
            'date' => '2026-06-10 10:00:00',
            'location' => 'Aula Utama',
            'price' => 30000,
            'stock' => 120,
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $entertainment->id,
            'title' => 'Jazz Night 2026',
            'description' => 'Musik santai di malam hari.',
            'date' => '2026-05-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-3.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $entertainment->id,
            'title' => 'E-Sport U-Champ',
            'description' => 'Turnamen game antar mahasiswa.',
            'date' => '2026-07-15 09:00:00',
            'location' => 'Lab Komputer',
            'price' => 25000,
            'stock' => 200,
            'poster_path' => 'posters/event-4.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $workshop->id,
            'title' => 'UI/UX Masterclass',
            'description' => 'Belajar desain UI/UX.',
            'date' => '2026-08-05 08:00:00',
            'location' => 'Ruang 204',
            'price' => 75000,
            'stock' => 80,
            'poster_path' => 'posters/event-5.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $workshop->id,
            'title' => 'Laravel Bootcamp',
            'description' => 'Belajar Laravel dari dasar.',
            'date' => '2026-09-01 09:00:00',
            'location' => 'Lab Programming',
            'price' => 60000,
            'stock' => 100,
            'poster_path' => 'posters/event-6.png',
        ]);
    }
}