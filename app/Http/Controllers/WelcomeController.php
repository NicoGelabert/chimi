<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        $services = Service::all();
        $portfolios = Portfolio::all();
            return view('welcome', [
                'features' => $features,
                'services' => $services,
                'portfolios' => $portfolios
        ]);
    }
}
