<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $user, $events;
    public function index()
    {
        if(auth()->user()){

            if(isset($_GET['add-event-success']) && isset($_COOKIE['lat']) && isset($_COOKIE['lng'])){
                $event = Event::find($_GET['add-event-success']);
                $event->location = json_encode([$_COOKIE['lat'], $_COOKIE['lng']]);
                $event->save();
            }

            $this->events = Event::all();
            $this->user = User::find(auth()->user()->id);
            return view('home', ['user' => $this->user, 'events' => $this->events]);
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
