<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
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
        $items = MenuItem::all();
        return view('menu_items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Menu $menu
     * @param  \App\MenuItem $parent
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu = null, MenuItem $parent = null)
    {
        //
        return view('menu_items.create', compact('menu', 'parent'));
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
        $item = new MenuItem();
        $item->menu_id = $request->menu_id;
        $item->parent_id = $request->parent_id;
        $item->item = $request->item;
        $item->link = $request->link;

        $item->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        //
        return view('menu_items.show', compact('menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuItem)
    {
        //
        return view('menu_items.edit', compact('menuItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        //
        $menuItem->item = $request->item;
        $menuItem->link = $request->link;

        $menuItem->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $item)
    {
        //
        $item->delete();
        return redirect()->back();
    }
}
