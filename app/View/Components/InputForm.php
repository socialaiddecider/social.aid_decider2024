<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $key, $placeholder, $type, $value, $required, $title, $disabled;

    public function __construct($key, $title, $placeholder, $type, $value = null, $required = true, $disabled = false)
    {
        $this->key = $key;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
        $this->title = $title;
        $this->disabled = $disabled;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-form');
    }
}
