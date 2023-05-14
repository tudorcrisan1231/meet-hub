<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class EventPage extends Component
{
    public $event_id, $event, $geo_location, $organizator, $participants, $openChat = 0, $chat_message, $chats;

    public function render()
    {
        return view('livewire.event-page');
    }

    public function mount(){
        $this->getStartData();
    }

    public function getStartData(){
        $this->event = Event::find($this->event_id);
        $this->organizator = User::find($this->event->organizer);
        $this->participants = User::whereIn('id', json_decode($this->event->users))->get();

        $coords = json_decode($this->event->location);
        $apiKey = 'f303ee4df8a344528a177207988f6d33';

        $url = "https://api.opencagedata.com/geocode/v1/json?q={$coords[0]}+{$coords[1]}&key={$apiKey}";
        
        $response = file_get_contents($url);
        $result = json_decode($response, true);
        $this->geo_location = $result['results'][0]['formatted'];
    }

    public function participate(){
        $event = Event::find($this->event_id);
        $users = json_decode($event->users);
        $users[] = auth()->user()->id;
        $event->users = json_encode($users);
        $event->save();
        return redirect()->to('/event/'.$this->event_id);
    }

    public function unparticipate(){


        $event = Event::find($this->event_id);

        if($this->event->organizer == auth()->user()->id){
            $event->status = 2;
            $event->save();
            return redirect()->to('/');
        } else {
            $users = json_decode($event->users);
            $users = array_diff($users, [auth()->user()->id]);
            $event->users = json_encode($users);
            $event->save();
            return redirect()->to('/event/'.$this->event_id);
        }
    }


    public function openChat(){
        $this->openChat = 1;
        $this->chats = Chat::where('event_id', $this->event_id)->where('status', '!=', 2)->get();
    }
    public function closeChat(){
        $this->openChat = 0;
    }

    public function sendMessage(){
        $chat = new Chat;
        $chat->sender_id = auth()->user()->id;
        $chat->event_id = $this->event_id;
        $chat->message = $this->chat_message;
        $chat->save();
        $this->chat_message = "";

        $this->chats = Chat::where('event_id', $this->event_id)->where('status', '!=', 2)->get();
    }
}
