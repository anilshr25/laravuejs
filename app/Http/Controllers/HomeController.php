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
