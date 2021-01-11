<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Validator;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
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
        //PermissionHandler::noMenuEditorAbort();
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
        //PermissionHandler::notCreateMenuAbort();
        return view('menu.create');
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
        //PermissionHandler::notCreateMenuAbort();
        Validator::validate($request, 'menu');

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->order = $request->order;

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
        //PermissionHandler::noMenuEditorAbort();
        return view('menu.show', compact('menu'));
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
        //PermissionHandler::notEditMenuAbort();
        return view('menu.edit', compact('menu'));
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
        //PermissionHandler::notEditMenuAbort();
        Validator::validate($request, 'menu_update');

        $menu->title = $request->title;
        $menu->order = $request->order;

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
        //PermissionHandler::notDeleteMenuAbort();
        $menu->delete();
        return redirect()->route('panel.menu');
    }
}
