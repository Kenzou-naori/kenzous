<?php

namespace App\Http\Controllers;

use App\Models\Landingpage;
use App\Models\Product;
use App\Models\User;
use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', Auth::user()->id)->get();
        return view('userhome', compact('users'));
    }
}
