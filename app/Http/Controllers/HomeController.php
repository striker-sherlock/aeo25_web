<?php

namespace App\Http\Controllers;

use App\Models\MediaPartner;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'mediaPartners' => MediaPartner::all(),
            'sponsors' => Sponsor::all(),
            
        ]);
    }
}
