<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inisialisasi Faker (ID untuk bahasa Indonesia, opsional)
        $faker = Faker::create('id_ID');

        // Perulangan untuk membuat minimal 5 data 
        for ($i = 1; $i <= 5; $i++) {
            DB::table('partners')->insert([
                'name'     => $faker->company, // Menghasilkan nama perusahaan fiktif 
                'logo_url' => "https://placehold.co/200x200?text=Logo+" . $i, // Mengikuti instruksi placeholder [cite: 24, 25]
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
