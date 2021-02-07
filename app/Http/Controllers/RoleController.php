<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Validator;
use App\Http\Traits\SearchTrait;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    use SearchTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', Role::class);

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
        Validator::validate($request, 'role');

        $role = new Role();
        $this->setRoles($request, $role);

        return redirect()->route('panel.roles')->with('success', 'Role successfully created.');
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
        Validator::validate($request, 'role');

        $this->setRoles($request, $role);

        return redirect()->route('panel.roles')->with('success', 'Role successfully updated.');
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
        Role::where('id', $role->id)->first()->delete();
        return redirect()->route('panel.roles');
    }

    public function searchRoles(Request $request)
    {
        $this->authorize('viewAny', Role::class);
        $columns = ['id', 'role'];
        $query = Role::select();
        $roles = $this->search($query, $columns, $request->keyword);
        $currentUserRole = Role::where('id', Auth::user()->role_id)->first();
        return view('role.index', compact('roles', 'currentUserRole'));
    }

    private function setRoles(Request $request, Role $role)
    {
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

        $role->edit_comment = (int)$request->edit_user;
        $role->delete_comment = (int)$request->delete_user;

        $role->create_media = (int)$request->create_media;
        $role->edit_media = (int)$request->edit_media;
        $role->delete_media = (int)$request->delete_media;

        $role->create_menu = (int)$request->create_menu;
        $role->edit_menu = (int)$request->edit_menu;
        $role->delete_menu = (int)$request->delete_menu;

        $role->save();
    }
}
