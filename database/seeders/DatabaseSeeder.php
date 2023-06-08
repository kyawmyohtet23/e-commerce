<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Admin::create([
        //     'name' => 'KMH',
        //     'email' => 'kmh@gmail.com',
        //     'password' => 'makeawish22',
        // ]);

        // Supplier::create([
        //     'name' => 'Kyaw Kyaw',
        //     'image' => 'linlat.jpg',
        // ]);

        Color::create([
            'name' => 'white',
            'slug' => 'white' . uniqid(),
        ]);

        Brand::create([
            'name' => 'Samsung',
            'slug' => 'Samsung' . uniqid(),
        ]);
    }
}
