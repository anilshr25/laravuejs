<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRole()
    {
        return Role::where('roleName','!=','User')->orderBy('id', 'desc')->get();
    }

    public function addRole(Request $request)
    {
        $this->validate($request, [
            'roleName' => 'required'
        ]);
        return Role::create([
            'roleName' => $request->roleName
        ]);
    }

    public function editRole(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'roleName' => 'required'
        ]);
        return Role::where('id', $request->id)->update([
            'roleName' => $request->roleName
        ]);
    }

    public function deleteRole(Request $request)
    {
        return Role::where('id', $request->id)->delete();
    }


    public function assignRole(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'permission' => 'required'
        ]);
        return Role::where('id', $request->id)->update([
            'permission' => $request->permission
        ]);
    }
}
