<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Land;
use App\Model\Crop;
class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index()
    {  $lands = Land::all();
        $crops = Crop::all();
        return view('home', compact( 'crops', 'lands' ) );
    }
}


