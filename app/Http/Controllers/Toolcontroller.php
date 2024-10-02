<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Toolcontroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //show notification
        session()->flash('notification', 'Welcome to the home page');
        return view('home');
    }
}
