<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResultTextarea extends Component
{
    public $total, $answers, $title, $description;
    public function __construct(
        public $data= null,
    )
    {
        if(!$data){ return; }
        $this->title = $data->title;
        $this->description = $data->description;
        $this->total = $data->result->{$data->title}->count;
        $this->answers = $data->result->{$data->title}->answers;        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.result_textarea');
    }
}
