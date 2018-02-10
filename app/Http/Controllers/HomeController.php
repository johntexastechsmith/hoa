<?php

namespace App\Http\Controllers;

use App\Hoa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hoa = Hoa::where('uri', $request->getHttpHost())->first();

        return view('home', ['hoa' => $hoa]);
    }
}
