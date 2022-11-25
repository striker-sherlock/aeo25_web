<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use App\Models\Sponsor;
use App\Models\Countries;
use App\Models\Competition;
use App\Models\MediaPartner;
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
            'countries' => Countries::all(),
            'competitions' => Competition::all(),
            'ambassadors' => Ambassador::all(),
            
        ]);
    }
}
