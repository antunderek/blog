<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Validator;
use App\Http\Traits\SearchTrait;
use App\Menu;
use App\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    use SearchTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(MenuItem::class, 'item');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', MenuItem::class);
        $items = MenuItem::get();
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
        Validator::validate($request, 'menu_item');

        $item = new MenuItem();
        $item->menu_id = $request->menu_id;
        $item->parent_id = $request->parent_id;
        $item->item = $request->item;
        $item->link = $request->link;

        $item->save();

        return redirect()->route('menu.edit', $item->menu_id)->with('success', 'Menu item successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $item)
    {
        //
        return view('menu_items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $item)
    {
        //
        return view('menu_items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $item)
    {
        //
        Validator::validate($request, 'menu_item_update');

        $item->item = $request->item;
        $item->link = $request->link;

        $item->save();
        return redirect()->back()->with('success', 'Menu item successfully updated.');
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
        return redirect()->back()->with('success', 'Menu item successfully deleted.');
    }

    public function searchMenuItems(Request $request)
    {
        $this->authorize('viewAny', MenuItem::class);
        $columns = ['id', 'menu_id', 'parent_id', 'item', 'link'];
        $query = MenuItem::select();
        $items = $this->search($query, $columns, $request->keyword, true, 30);
        return view('menu_items.index', compact('items'));
    }
}
