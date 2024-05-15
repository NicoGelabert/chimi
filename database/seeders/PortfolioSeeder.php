<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('portfolios')->insert([
            'title' => 'Homenaje a Fernando Peña',
            'image' => 'storage/portfolio/el-parquimetro-homanaje-a-fernando-pena.jpg',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Promo Carrera de Producción',
            'image' => 'storage/portfolio/publi-carrera-produccion.jpg',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Mick',
            'image' => 'storage/portfolio/eter-sos-lo-que-estudias.png',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Mick',
            'image' => 'storage/portfolio/isologo-sur-comunica.jpg',
            'client' => 'Isologo Sur Comunica',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Arte Stone',
            'image' => 'storage/portfolio/arte-stone.jpg',
            'client' => 'Inspiración Rolling Stone',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Amor',
            'image' => 'storage/portfolio/amor.jpg',
            'client' => 'Licenciada Graciela Antes',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Isologo 100 años de radio',
            'image' => 'storage/portfolio/isologo-100-anos-de-radio.jpg',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Logo Rada',
            'image' => 'storage/portfolio/logotipo-rada.jpg',
            'client' => 'Rada Zapatos',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Promo ETER Carreras',
            'image' => 'storage/portfolio/publi-eter-carreras.jpg',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Isologo Bamboo',
            'image' => 'storage/portfolio/isologo-bamboo-sushi-wok.jpg',
            'client' => 'Bamboo Sushi & Wok',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Publi Johnnie Walker',
            'image' => 'storage/portfolio/publi-johnny-walker.jpg',
            'client' => 'Escuela de Creativos Publicitarios',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Diseño Editorial - Skatalites',
            'image' => 'storage/portfolio/editorial-skatalites.jpg',
            'client' => 'Escuela de Creativos Publicitarios',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Diploma Premios ETER',
            'image' => 'storage/portfolio/premioseter-diploma.png',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Efeméride 24 de marzo',
            'image' => 'storage/portfolio/nunca-mas-pandemia.jpg',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
        DB::table('portfolios')->insert([
            'title' => 'Señalador ETER carreras',
            'image' => 'storage/portfolio/eter-senalador.png',
            'client' => 'ETER, Escuela de Comunicación',
        ]);
    }
}
