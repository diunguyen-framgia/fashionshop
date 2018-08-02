<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status ==0){
            return view('home');
        }
        elseif (Auth::user()->status == 1)
        {
            return view('homeadmin');
        }
        else
        {
            return view('welcome');
        }
    }

    public function homeadmin()
    {
        if ( Auth::user()->status){
            return view('homeadmin');
        }
        else
        {
            return view('welcome');
        }
    }
}
