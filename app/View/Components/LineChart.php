<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LineChart extends Component
{
    public $id;
    public $labels;
    public $series;
    public $title;

    public function __construct($id = 'lineChart')
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('components.line-chart');
    }
}