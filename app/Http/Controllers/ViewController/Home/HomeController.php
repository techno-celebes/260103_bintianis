<?php

namespace App\Http\Controllers\ViewController\Home;

use App\Http\Controllers\ViewController\Master\MasterHomeViewController;
use Inertia\Inertia;

class HomeController extends MasterHomeViewController{
    public function home(){
        return Inertia::render('Home/Home');
    }

    public function event_order(){
        return Inertia::render('Home/EventOrder');
    }
}