<?php

namespace Database\Seeders;

use App\Models\HomeHeroBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeHeroBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeHeroBanner::factory(3)->create();
    }
}
