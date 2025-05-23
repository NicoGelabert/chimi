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
        
        // Si queremos usar el project-modal para todos los servicios, usamos esta query y no necesitamos $devprojects
        $projects = Project::with('services', 'tags', 'clients')
            ->whereHas('services', function ($query) use ($service) {
                $query->where('service_id', $service->id)->where('published', 1);
            })
            ->orderBy('id', 'desc')
            ->get();

        // Projectos filtrados por id=1 (desarrollo web)
        // $devprojects = Project::with('services', 'tags', 'clients')->whereHas('services', function($query) {
        //     $query->where('service_id', 1)->where('published', 1);
        // })->orderBy('id', 'desc')->get();
        // // Projectos filtrados por id=2 (diseño gráfico)
        // $projects = Project::with('services', 'tags', 'clients')->whereHas('services', function($query) {
        //     $query->where('service_id', 2)->where('published', 1);
        // })->get();
        $projectsJson = $projects->map(function ($project) {
            return [
                'image' => $project->image,
                'title' => $project->title,
                'short_description' => $project->short_description,
                'slug' => $project->slug,
                'service_slug' => optional($project->services->first())->slug,
                'tags' => $project->tags->pluck('name'),
                'clients' => $project->clients->pluck('name'),
            ];
        })->values();
        $tags = Tag::all();
        return view('services.view', compact(
            'service',
            'projects',
            'projectsJson',
            'service_buttons',
            'tags'
        ));
    }
}
