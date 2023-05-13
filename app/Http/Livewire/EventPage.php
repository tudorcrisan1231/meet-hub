<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventPage extends Component
{
    public $event_id;
    public function render()
    {
        return view('livewire.event-page');
    }
}
