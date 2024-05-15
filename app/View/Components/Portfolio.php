<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Portfolio extends Component
{
    public $portfolios;
    /**
     * Create a new component instance.
     * @param  mixed  $portfolios
     * @return void
     */
    public function __construct($portfolios)
    {
        $this->portfolios = $portfolios;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.portfolio');
    }
}
