<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if($user->userType == 'User') {
                Auth::logout();
                return response()->json([
                    'msg' => 'Incorrect Email or Password Details'
                ], 401);
            } else {
                return response()->json([
                    'msg' => 'You are logged in',
                    'user' => $user
                ]);
            }
        } else {
            return response()->json([
                'msg' => 'Incorrect Email or Password Details'
            ], 401);
        }
    }

    public function getUser()
    {
        return User::where('userType', '!=', 'user')->orderBy('id', 'desc')->get();
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'userType' => 'required',
        ]);

        $password = bcrypt($request->password);

        return User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $password,
            'userType' => $request->userType,
        ]);
    }

    public function editUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'fullname' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'userType' => 'required',
        ]);
        return User::where('id', $request->id)->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'userType' => $request->userType,
        ]);
    }

    public function deleteUser(Request $request)
    {
        return User::where('id', $request->id)->delete();
    }
}
