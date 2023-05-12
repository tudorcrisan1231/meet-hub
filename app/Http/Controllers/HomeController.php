<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $user;
    public function index()
    {
        if(auth()->user()){
            $this->user = User::find(auth()->user()->id);
            return view('home', ['user' => $this->user]);
        } else {
            return redirect()->to('login')->with('error','You must login first.');
        }
    }
}
