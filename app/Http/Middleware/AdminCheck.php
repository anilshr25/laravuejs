<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->path() == 'login') {
            return $next($request);
        }
       if(!Auth::check() && $request->path() == 'login') {
            return response()->json([
                'msg' => 'You are not allowd to access'
            ], 403);
        }

        $user = Auth::user();
        if($user != null){
            if($user->role->roleName == "User") {
                return response()->json([
                    'msg' => 'You are not allowd to access'
                ], 401);
            }
        }

        // return response()->json([
        //     'msg' => 'You are have access',
        //     'user' => Auth::user(),
        //     'user' => $request,
        // ]);
        return $next($request);
    }
}
