<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    public $tag = 'input';

    public $name;

    public $id;

    public $label;

    public $required;

    public $type;

    public $value;

    public $class;

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
        $this->class = $this->getClass($type);

        if ($type == 'textarea') {
            $this->tag = 'textarea';
        }
    }

    private function getClass(string $type)
    {
        if ($type == 'checkbox')
            return "checkbox checkbox-primary";
        elseif ($type == 'file')
            return "file-input file-input-bordered w-full";
        elseif ($type == 'date')
            return "input input-bordered w-full";
        elseif ($type == 'textarea')
            return "textarea textarea-bordered w-full";
        else
            return "input input-bordered w-full";
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
