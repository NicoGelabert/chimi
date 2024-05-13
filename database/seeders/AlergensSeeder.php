<?php

namespace Database\Seeders;

use App\Models\Alergens;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlergensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alergens')->insert([
            'name' => 'Gluten',
            'icon' => 'storage/iconos/gluten.svg'
        ]);
        DB::table('alergens')->insert([
            'name' => 'Lactose',
            'icon' => 'storage/iconos/lactose.svg'
        ]);
        DB::table('alergens')->insert([
            'name' => 'Sugar',
            'icon' => 'storage/iconos/sugar.svg'
        ]);
        DB::table('alergens')->insert([
            'name' => 'Egg',
            'icon' => 'storage/iconos/egg.svg'
        ]);
    }
}
