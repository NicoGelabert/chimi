<?php

namespace App\Http\Controllers;

use App\Models\Service;
// use App\Models\ServiceItem;
use App\Models\Project;
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
        // // $service_portfolios = $service->serviceItems()->with('portfolios.client', 'portfolios.serviceItems')->get()->pluck('portfolios')->flatten()->unique('id');
        
        // // Obtenemos todos los Attributes y carga la relación con Service
        // $srvAttributes = Attributes::with('service')->get();
        // // Agrupamos los Attributes por el servicio
        // $groupedSrvAttributes = $srvAttributes->groupBy('service_id');

        // // Obtenemos todos los ServiceItem y carga la relación con Service
        // 
        // // Agrupamos los items por el servicio
        $service_buttons = Service::all();
        $projects = Project::with('services', 'tags', 'clients')->whereHas('services', function($query) {
            $query->where('service_id', 2)->where('published', 1);
        })->get();
        $devprojects = Project::with('services', 'tags', 'clients')->whereHas('services', function($query) {
            $query->where('service_id', 1)->where('published', 1);
        })->orderBy('id', 'desc')->get();
        $tags = Tag::all();
        return view('services.view', compact(
            'service',
            'projects',
            'devprojects',
            'service_buttons',
            'tags'
        ));
    }
}
