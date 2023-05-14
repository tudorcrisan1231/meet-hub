<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Theme;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddEvent extends Component
{
    use WithFileUploads;

    public $event_img, $event_name, $event_date, $event_time, $event_location, $event_description, $event_limit, $event_theme;
    public $themes;
    public function addEvent()
    {
        $event = new Event;
        $event->name = $this->event_name;
        $event->description = $this->event_description;
        $event->date = $this->event_date;
        $event->time = $this->event_time;
        if($this->event_img){
            $event->image = $this->event_img->store('photos', 'public');
        }
        $users[] = auth()->user()->id;
        $event->users = json_encode($users);
        $event->status = 0;
        $event->type = $this->event_theme;
        $event->limit = $this->event_limit;
        $event->organizer = auth()->user()->id;
        $event->hour = "12:00";
        $event->save();

        $this->event_img = "";
        $this->event_name = "";
        $this->event_date = "";
        $this->event_time = "";
        $this->event_description = "";
        $this->event_limit = "";

        return redirect()->to('/?add-event-success='.$event->id);
    }

    public function mount(){
        $this->themes = Theme::all();
        $this->event_theme = $this->themes[0]->name;
    }

    public function render()
    {
        //rerender the js from component
        $this->emit('js');

        return view('livewire.add-event');
    }
}
