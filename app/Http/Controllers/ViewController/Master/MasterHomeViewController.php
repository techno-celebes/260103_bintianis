<?php

namespace App\Http\Controllers\ViewController\Master;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterHomeViewController extends Controller
{
    protected $title;

    public function __construct()
    {
        Inertia::setRootView('app');

        Inertia::share([
            'app_tagline' => 'Bintianis',
            'app_s' => 'Bintianis',
        ]);
    }
}