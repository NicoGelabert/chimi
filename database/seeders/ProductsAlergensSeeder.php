<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsAlergensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products_alergens')->insert([
            'product_id' => '1',
            'alergen_id' => '1'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '1',
            'alergen_id' => '2'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '1',
            'alergen_id' => '3'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '1',
            'alergen_id' => '4'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '2',
            'alergen_id' => '1'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '2',
            'alergen_id' => '3'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '2',
            'alergen_id' => '4'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '3',
            'alergen_id' => '2'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '3',
            'alergen_id' => '4'
        ]);
        DB::table('products_alergens')->insert([
            'product_id' => '4',
            'alergen_id' => '3'
        ]);
    }
}
