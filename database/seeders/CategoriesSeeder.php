<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Tartas y Muffins',
            'slug' => 'tartas-y-muffins',
            'icon' => 'storage/iconos/tartas.svg'
        ]);
        DB::table('categories')->insert([
            'name' => 'Empanadas',
            'slug' => 'empanadas',
            'icon' => 'storage/iconos/empanadas.svg'
        ]);
        DB::table('categories')->insert([
            'name' => 'Desayunos',
            'slug' => 'desayunos',
            'icon' => 'storage/iconos/desayunos.svg'
        ]);
        DB::table('categories')->insert([
            'name' => 'Encargos especiales',
            'slug' => 'encargos-especiales',
            'icon' => 'storage/iconos/encargos.svg'
        ]);
    }
}
