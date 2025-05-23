<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Portfolio extends Component
{
    public $service;
    public $projects;
    public $projectsJson;
    /**
     * Create a new component instance.
     * @param  mixed  $projectsJson
     * @return void
     */
    public function __construct($service, $projects, $projectsJson)
    {
        $this->service = $service;
        $this->projects = $projects;
        $this->projectsJson = $projectsJson;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.portfolio');
    }
}
