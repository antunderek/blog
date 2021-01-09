<?php

namespace App\Http\Controllers;

use App\DefaultRole;
use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Validator;
use App\Role;
use Illuminate\Http\Request;

class DefaultRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        PermissionHandler::notEditRolesAbort();
        $roles = Role::all();
        return view('default_role.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        PermissionHandler::notEditRolesAbort();
        Validator::validate($request, 'default_role');

        $defaultRole = DefaultRole::first();
        if (!$defaultRole)
        {
            $defaultRole = new DefaultRole();
        }
        $defaultRole->role_id = $request->role;
        $defaultRole->save();

        return redirect()->route('panel.roles');
    }
}
