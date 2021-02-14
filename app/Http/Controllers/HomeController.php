<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        if(Auth::user() && $request->path() == 'login') {
            return redirect('/');
        }
        return view('mainapp');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
