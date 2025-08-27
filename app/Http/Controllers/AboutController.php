<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function aboutAdmin()
    {
        return view('WebMonitor.website.about');
    }
    public function index()
    {
        return view('website.about');
    }

}
