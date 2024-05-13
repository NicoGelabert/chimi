<?php

namespace Database\Seeders;

use App\Models\HomeHeroBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeHeroBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_hero_banners')->insert([
            'image' => 'storage/img/chessecake_transparent.webp',
            'headline' => 'Tarta de Queso',
            'description' => 'Una irresistible combinación de queso crema y nata sobre una base de galleta crujiente.',
            'slug' => 'tarta-de-queso',
            'link' => '/menu/tartas/cheese-cake',
            'background' => 'transparent'
        ]);
        DB::table('home_hero_banners')->insert([
            'image' => 'storage/img/carrotcake_ingredients_large.webp',
            'headline' => 'Tarta de Zanahoria',
            'description' => 'Una mezcla tentadora de zanahoria con la suavidad del queso hecho crema y nueces trituradas.',
            'slug' => 'tarta-de-zanahoria',
            'link' => '/menu/tartas/carrot-cake',
            'background' => 'transparent'
        ]);
    }
}
