<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddEventController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()){
            return view('add-event');
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
