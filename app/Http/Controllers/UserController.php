<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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
            if($user->role->roleName == "User") {
                Auth::logout();
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

    public function getUser()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function addUser(UserRequest $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required',
        ]);

        $password = bcrypt($request->password);

        return User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $request->role_id,
        ]);
    }

    public function editUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'fullname' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'role_id' => 'required',
        ]);
        return User::where('id', $request->id)->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
    }

    public function deleteUser(Request $request)
    {
        return User::where('id', $request->id)->delete();
    }
}
