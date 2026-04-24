<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1. Akun Admin Utama 
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Insert Kategori Event 
        $category = \App\Models\Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);
        $category2 = \App\Models\Category::firstOrCreate([
            'name' => 'Entertaiment',
            'slug' => 'entertaiment',
        ]);

        // 3. Insert Sampel Events 
        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'Jazz Night 2025',
            'description' => 'Nikmati  malam  yang  indah  dengan  alunan  musik  jazz yang merdu.',
            'date' => '2026-05-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'Hackaton - Unleash Your Inner Developer',
            'description' => 'Ayo  asah  skill  coding  kamu  dan  ciptakan  solusi inovatif untuk tantangan masa depan!',
            'date' => '2026-05-05 10:00:00',
            'location' => 'Inkubator Amikom',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'AI & FUTURE TECH SUMMIT 2026',
            'description' => 'Jelajahi  tren  terkini  dalam  kecerdasan  buatan  dan teknologi masa depan bersama para ahli di bidangnya.',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Cinema Unit 6',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-3.png',
        ]);

         \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'Hackaton - Web3 Revolution',
            'description' => 'Bergabunglah dalam hackathon kami dan eksplorasi potensi Web3!',
            'date' => '2026-06-05 09:00:00',
            'location' => 'Inkubator Amikom',
            'price' => 55000,
            'stock' => 150,
            'poster_path' => 'posters/event-4.png',
        ]);

         \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'Workshop - Building Scalable APIs with Laravel',
            'description' => 'Pelajari cara membangun API yang scalable dan efisien menggunakan Laravel dalam workshop intensif ini.',
            'date' => '2026-05-05 13:00:00',
            'location' => 'Inkubator Amikom',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-5.png',
        ]);

         \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'Bootcamp - Mastering Data Science with Python',
            'description' => 'Ikuti bootcamp intensif kami dan kuasai data science dengan Python, mulai dari analisis data hingga machine learning.',
            'date' => '2026-05-01 08:00:00',
            'location' => 'Cinema Unit 6',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-6.png',
        ]);
    }
}