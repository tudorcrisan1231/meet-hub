<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class MyEventController extends Controller
{
    //
    public $events;
    public function index()
    {
        
        if(auth()->user()){
            $this->events = Event::where('organizer', auth()->user()->id)->get();
            return view('my-events', ['events' => $this->events]);
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
