<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    //actions
    public function welcome()
    {
        return view('welcome');
    }
}
