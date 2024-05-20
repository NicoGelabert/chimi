<?php

namespace App\Http\Controllers;

use App\Models\HomeHeroBanner;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $homeherobanners = HomeHeroBanner::all();
        $features = Feature::all();
        $services = Service::all();
        $portfolios = Portfolio::all();
        return view('welcome', [
            'homeherobanners' => $homeherobanners,
            'features' => $features,
            'services' => $services,
            'portfolios' => $portfolios
        ]);
    }
}
