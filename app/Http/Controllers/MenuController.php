<?php

namespace App\Http\Controllers;

use App\Http\Traits\SearchTrait;
use App\Menu;
use App\Role;
use App\Http\Helpers\Validator;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use SearchTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Menu::class, 'menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', Menu::class);

        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('menu.create', compact('roles'));
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
        Validator::validate($request, 'menu');

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->order = $request->order;

        $menu->save();

        foreach ($request->roles as $role) {
            $menu->roles()->attach($role);
        }

        $menu->save();

        return redirect()->route('panel.menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
        $roles = Role::all();
        return view('menu.show', compact('menu', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
        $roles = Role::all();
        return view('menu.edit', compact('menu', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
        Validator::validate($request, 'menu_update');

        $menu->title = $request->title;
        $menu->order = $request->order;

        $menu->roles()->detach();
        foreach ($request->roles as $role) {
            $menu->roles()->attach($role);
        }

        $menu->save();
        return view('menu.show', compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
        $menu->delete();
        return redirect()->route('panel.menu');
    }

    public function searchMenus(Request $request)
    {
        $this->authorize('viewAny', Menu::class);

        $columns = ['id', 'title'];
        $query = Menu::select();
        $menus = $this->search($query, $columns, $request->keyword);
        return view('menu.index', compact('menus'));
    }
}
