<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if($user->role->roleName == "User") {
                return response()->json([
                    'msg' => 'Incorrect Email or Password Details!!'
                ], 401);
            } else {
                return response()->json([
                    'msg' => 'You are logged in',
                ]);
            }
        } else {
            return response()->json([
                'msg' => 'Incorrect Email or Password Details!'
            ], 401);
        }
    }

    public function checkLogin(Request $request)
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

        // return $this->checkForPermission($user, $request);

        return view('mainapp');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
