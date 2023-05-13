<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddEvent extends Component
{
    public $event_img, $event_name, $event_date, $event_time, $event_location, $event_description, $event_limit;
    public function render()
    {
        //rerender the js from component
        $this->emit('js');
        return view('livewire.add-event');
    }
}
