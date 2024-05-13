<?php

namespace Database\Seeders;

use App\Models\SliderImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('slider_images')->insert([
            'image' => 'storage/img/first_cake.png',
            'headline' => 'Torta nº1',
            'description' => 'ingredientes de la tarta Torta nº1 o descripción poética de la tarta.',
            'link' => '/menu/tartas-y-muffins/non-aliquid-provident-corporis-ex-laudantium-sed-sit-placeat-doloribus-quos-debitis-voluptatibus-animi-non-ratione-dolorem-molestiae-autem',
            'background' => 'linear-gradient(90deg, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%)'
        ]);
        DB::table('slider_images')->insert([
            'image' => 'storage/img/first_cake.png',
            'headline' => 'Torta nº2',
            'description' => 'ingredientes de la tarta Torta nº2 o descripción poética de la tarta.',
            'link' => '/menu/empanadas/nam-ab-fuga-sint-magni-recusandae-vel-dolorum-neque-aperiam-expedita-ea-autem-quasi-magnam-similique-ut',
            'background' => 'linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%)'
        ]);
        DB::table('slider_images')->insert([
            'image' => 'storage/img/first_cake.png',
            'headline' => 'Torta nº3',
            'description' => 'ingredientes de la tarta Torta nº3 o descripción poética de la tarta.',
            'link' => '/menu/desayunos/perferendis-perferendis-sit-dolorem-voluptas-dolores-velit-dolor-a-impedit-ut-aut-itaque-aut-totam-aut-consequatur-suscipit',
            'background' => 'linear-gradient(90deg, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%)'
        ]);
        DB::table('slider_images')->insert([
            'image' => 'storage/img/first_cake.png',
            'headline' => 'Torta nº4',
            'description' => 'ingredientes de la tarta Torta nº4 o descripción poética de la tarta.',
            'link' => '/menu/encargos-especiales/labore-explicabo-nihil-assumenda-labore-repellat-voluptatem-quia-minima-ad-nam-rem-culpa-vel-est-quia-consequatur-quia-tenetur-ut-veniam',
            'background' => 'linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%)'
        ]);
    }
}
