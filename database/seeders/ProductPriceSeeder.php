<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_price')->insert([
            'product_id' => '1',
            'price_id' => '1'
        ]);
        DB::table('product_price')->insert([
            'product_id' => '1',
            'price_id' => '2'
        ]);
        DB::table('product_price')->insert([
            'product_id' => '2',
            'price_id' => '3'
        ]);
        DB::table('product_price')->insert([
            'product_id' => '2',
            'price_id' => '4'
        ]);
        DB::table('product_price')->insert([
            'product_id' => '3',
            'price_id' => '5'
        ]);
        DB::table('product_price')->insert([
            'product_id' => '3',
            'price_id' => '6'
        ]);
        DB::table('product_price')->insert([
            'product_id' => '4',
            'price_id' => '7'
        ]);

    }
}
