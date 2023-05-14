<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class MyEventController extends Controller
{
    //
    public $events, $joined=0;
    public function index()
    {
        
        if(auth()->user()){
            if(isset($_GET['joined'])){
                $this->joined = 1;
                //get all events that where auth user is in users using whereJsonContains
                $this->events = Event::whereJsonContains('users', auth()->user()->id)->get();
            } else {
                $this->events = Event::where('organizer', auth()->user()->id)->get();
                $this->joined = 0;
            }

            return view('my-events', ['events' => $this->events], ['joined' => $this->joined]);
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
