<?php

namespace Database\Seeders;

use App\Models\ServiceItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_items')->insert([
            'title' => 'Desarrollo de sitios web responsivos y adaptativos.',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Desarrollo de sitios web estáticos o dinámicos.',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Desarrollo de tiendas en línea (e-commerce).',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Optimización para motores de búsqueda (SEO).',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Integración de sistemas de análisis web como Google Analytics.',
            'service_id' => 1,
        ]);
        
        DB::table('service_items')->insert([
            'title' => 'Optimización de velocidad y rendimiento del sitio web.',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Mantenimiento web y actualizaciones periódicas.',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Asesoramiento técnico y consultoría.',
            'service_id' => 1,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Creación de logotipos.',
            'service_id' => 2,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Diseño de identidad de marca.',
            'service_id' => 2,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Diseño de folletos, volantes y material publicitario impreso.',
            'service_id' => 2,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Diseño de tarjetas de visita y papelería corporativa.',
            'service_id' => 2,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Diseño de empaques y etiquetas.',
            'service_id' => 2,
        ]);        
        DB::table('service_items')->insert([
            'title' => 'Diseño de empaques y etiquetas.',
            'service_id' => 2,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Estrategia de branding digital.',
            'service_id' => 3,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Creación de contenido visual para redes sociales.',
            'service_id' => 3,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Gestión de redes sociales.',
            'service_id' => 3,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Publicidad en línea (Google Ads, Facebook Ads, etc.).',
            'service_id' => 3,
        ]);
        DB::table('service_items')->insert([
            'title' => 'Email marketing y creación de boletines.',
            'service_id' => 3,
        ]);
    }
}
