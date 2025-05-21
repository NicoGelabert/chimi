<?php

namespace App\Http\Controllers;

use App\Models\HomeHeroBanner;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Client;
use App\Models\Project;
use App\Models\Faq;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $homeherobanners = HomeHeroBanner::all();
        $features = Feature::all();
        $service = Service::all();
        $services = Service::all();
        $tags = Tag::all();
        $clients = Client::all();
        $projects = Project::with('services', 'tags', 'clients')->whereHas('services', function($query) {
            $query->where('service_id', 2);
        })->get();
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

        $devprojects = Project::with('services', 'tags', 'clients')->whereHas('services', function($query) {
            $query->where('service_id', 1)->where('published', 1);
        })->orderBy('id', 'desc')->limit(2)->get();
        $faqs = Faq::all();
        return view('welcome', compact(
            'homeherobanners',
            'features',
            'service',
            'services',
            'tags',
            'clients',
            'projects',
            'projectsJson',
            'devprojects',
            'faqs'
        ));
    }
}
