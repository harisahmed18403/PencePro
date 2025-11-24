<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    public $name;

    public $id;

    public $label;

    public $required;

    public $type;

    public $value;

    public $additionalAttributes;
    public function __construct(
        $name,
        $label,
        $value = null,
        $id = null,
        $required = true,
        $type = 'text',
        $additionalAttributes = false
    ) {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
        $this->type = $type;
        $this->additionalAttributes = $additionalAttributes;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
