<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class EventPageController extends Controller
{
    //
    public function index($id)
    {
        if(auth()->user()){
            return view('event-page', ['id' => $id]);
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
