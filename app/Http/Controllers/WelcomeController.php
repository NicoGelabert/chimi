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
        $services = Service::all();
        $tags = Tag::all();
        $clients = Client::all();
        $projects = Project::with('tags', 'clients')->whereHas('services', function($query) {
            $query->where('service_id', 2);
        })->get();
        $devprojects = Project::with('tags', 'clients', 'services')->whereHas('services', function($query) {
            $query->where('service_id', 1)->where('published', 1);
        })->orderBy('id', 'desc')->limit(2)->get();
        $faqs = Faq::all();
        return view('welcome', compact(
            'homeherobanners',
            'features',
            'services',
            'tags',
            'clients',
            'projects',
            'devprojects',
            'faqs'
        ));
    }
}
