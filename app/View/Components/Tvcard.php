<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tvcard extends Component
{
    /**
     * Create a new component instance.
     */

     public $tvshows;
    public function __construct($tvshows)
    {
        $this->tvshows = $tvshows;    
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tvcard');
    }
}
