<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Mobil Baru',
                'description' => 'Kategori untuk mobil yang masih baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobil Bekas',
                'description' => 'Kategori untuk mobil bekas atau second hand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobil Listrik',
                'description' => 'Kategori untuk mobil listrik ramah lingkungan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}