<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LineChart extends Component
{
    public $id;
    public $labels;
    public $series;
    public $title;

    public function __construct($id = 'lineChart', $labels = [], $series = [], $title = 'Line Chart')
    {
        $this->id = $id;
        $this->labels = $labels;
        $this->series = $series;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.line-chart');
    }
}