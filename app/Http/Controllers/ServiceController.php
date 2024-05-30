<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Portfolio;
use App\Models\Tag;
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
        
        // Obtenemos todos los ServiceItem y carga la relación con Service
        $srvItems = ServiceItem::with('service')->get();
        // Agrupamos los items por el servicio
        $groupedSrvItems = $srvItems->groupBy('service_id');

        // Obtenemos todos los ServiceItem y carga la relación con Service
        $tags = Tag::with('service')->get();
        // Agrupamos los items por el servicio
        $groupedTags = $tags->groupBy('service_id');
        
        $services = Service::all();
        return view('services.view', ['service' => $service, 'tags' => $tags, 'groupedTags' => $groupedTags, 'service_portfolios' => $service_portfolios, 'services' => $services]);
    }
}
