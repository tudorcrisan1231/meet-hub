<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()){
            return view('profile');
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
