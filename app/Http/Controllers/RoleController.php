<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Validator;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        PermissionHandler::noRoleEditorAbort();

        $roles = Role::all();
        $currentUserRole = Role::where('id', Auth::user()->role_id)->first();
        return view('role.index', compact('roles', 'currentUserRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        PermissionHandler::notCreateRolesAbort();
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        PermissionHandler::notCreateRolesAbort();
        Validator::validate($request, 'role');

        $role = new Role();
        $role->role = $request->role;
        $role->writer = (int)$request->writer;
        $role->edit_article = (int)$request->edit_article;
        $role->delete_article = (int)$request->delete_article;

        $role->create_role = (int)$request->create_role;
        $role->edit_role = (int)$request->edit_role;
        $role->delete_role = (int)$request->delete_role;

        $role->create_user = (int)$request->create_user;
        $role->edit_user = (int)$request->edit_user;
        $role->delete_user = (int)$request->delete_user;

        $role->save();

        return redirect()->route('panel.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        PermissionHandler::noRoleEditorAbort();
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        PermissionHandler::notEditRolesAbort();
        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        PermissionHandler::notEditRolesAbort();
        Validator::validate($request, 'role');

        $role->role = $request->role;
        $role->writer = (int)$request->writer;
        $role->edit_article = (int)$request->edit_article;
        $role->delete_article = (int)$request->delete_article;

        $role->create_role = (int)$request->create_role;
        $role->edit_role = (int)$request->edit_role;
        $role->delete_role = (int)$request->delete_role;

        $role->create_user = (int)$request->create_user;
        $role->edit_user = (int)$request->edit_user;
        $role->delete_user = (int)$request->delete_user;

        $role->save();

        return redirect()->route('panel.roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        PermissionHandler::notDeleteRolesAbort();
        Role::where('id', $role->id)->first()->delete();
        return redirect()->route('panel.roles');
    }
}
