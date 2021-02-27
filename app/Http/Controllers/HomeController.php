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
        // if not logged then it will redirect to login
        if(!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        if(!Auth::check() && $request->path() == 'login'){
            return view('mainapp');
        }

        if(Auth::check() && $request->path() == 'login') {
            return redirect('/');
        }

        $user = Auth::user();

        // if($user != null) {
        //     if($user->role->roleName ) {

        //     }
        // }

        return $this->checkForPermission($user, $request);

        return view('mainapp');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function checkForPermission($user, $request)
    {
        $permissions = json_decode($user->role->permission);

        $hasPermission = false;

        if($permissions != null){
            foreach($permissions as $permission) {
                if($permission->name == $request->path()){
                    if($permission->read){
                        $hasPermission = true;
                    }
                }
            }
        }else {
            return view('mainapp');
        }

        if($hasPermission) return view('mainapp');
        return abort(403);
    }
}
