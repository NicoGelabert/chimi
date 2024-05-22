<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', [
            'services' => $services
        ]);
    }

    public function view(Service $service)
    {
        $service_portfolios = $service->serviceItems()->with('portfolios.client', 'portfolios.serviceItems')->get()->pluck('portfolios')->flatten()->unique('id');
        $services = Service::all();
        return view('services.view', ['service' => $service, 'service_portfolios' => $service_portfolios, 'services' => $services]);
    }
}
