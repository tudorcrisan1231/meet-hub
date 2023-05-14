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
           
            $this->user = User::find(auth()->user()->id);
            if($this->user->hobbies){
                $user_hobbies = json_decode($this->user->hobbies);
            } else {
                $user_hobbies = [];
            }
            

            //get all events that match user's hobbies
            $this->events = Event::where(function($query) use ($user_hobbies){
                foreach($user_hobbies as $hobby){
                    $query->orWhere('type', 'like', '%'.$hobby.'%');
                }
            })->get();

            //then merge in all events the rest of the events
            $this->events = $this->events->merge(Event::where(function($query) use ($user_hobbies){
                foreach($user_hobbies as $hobby){
                    $query->orWhere('type', 'not like', '%'.$hobby.'%');
                }
            })->get());

            // dd($this->events);

            return view('home', ['user' => $this->user, 'events' => $this->events]);
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
