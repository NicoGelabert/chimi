<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // AdminUserSeeder::class,
            // CountrySeeder::class,
            // CategoriesSeeder::class,
            // ProductSeeder::class,
            // AlergensSeeder::class,
            // ProductsAlergensSeeder::class,
            // SliderImagesSeeder::class,
            // HomeHeroBannerSeeder::class,
            // PriceSeeder::class,
            ProductPriceSeeder::class,
        ]);
    }
}
