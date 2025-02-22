<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use App\Models\Sponsor;
use App\Models\Countries;
use App\Models\Competition;
use App\Models\Faq;
use App\Models\MediaPartner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsShowed:ENV004');
    }

    public function index()
    {
        return view('home', [
            'mediaPartners' => MediaPartner::all(),
            'sponsors' => Sponsor::all(),
            'countries' => Countries::orderBy('name')->get(),
            'competitions' => Competition::all(),
            'ambassadors' => Ambassador::all(),
            'faqs' => Faq::all(),
        ]);
    }
}
