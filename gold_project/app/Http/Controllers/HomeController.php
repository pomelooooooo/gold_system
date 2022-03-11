<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->row_id == '0'){
            return view('admin.median_price.index');
            }
        
        if(Auth::user()->row_id == '1'){
            return view('user.median_price.index');
        }
        // return view('admin.median_price.index');
    }

    // public function fistpage()
    // {
    //     return view('firstpage');
    // }
}
