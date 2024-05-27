<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterLayout extends Component
{
    /**
     * Create a new component instance.
     */

    public $brandLogo, $belowLinks, $sosmedLinks;

    public function __construct($brandLogo, $belowLinks, $sosmedLinks)
    {
        $this->brandLogo = $brandLogo;
        $this->belowLinks = $belowLinks;
        $this->sosmedLinks = $sosmedLinks;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer-layout');
    }
}
