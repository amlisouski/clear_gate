<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RiggingPlan extends Component
{
    protected int $plan;

    /**
     * Create a new component instance.
     */
    public function __construct(int $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render($colorize = false): string
    {
        $no = $colorize === true ?
            '<span class="text-danger">NO</span>' :
            'NO';
        return ($this->plan === 0) ? $no : $this->plan;
    }
}
