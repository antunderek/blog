<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\Http\Helpers\AvatarCreator;
use App\Http\Helpers\PermissionHandler;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
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
        PermissionHandler::noMediaEditorAbort();
        $images = Avatar::all();
        return view('avatar.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        PermissionHandler::notCreateMediaAbort();
        return view('avatar.create');
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
        PermissionHandler::notCreateMediaAbort();

        if ($request->file('image')) {
            $avatar = new Avatar();
            $avatar->image_path = $request->file('image')->store('public/avatars');
            $avatar->size = $request->file('image')->getSize();
            $imageresolution = getimagesize($request->file('image'));
            $avatar->resolution = "{$imageresolution[0]}x{$imageresolution[1]}";

            if ($request->default == 1) {
                $defaultAvatar = Avatar::where('default', true)->get();
                if ($defaultAvatar) {
                    $defaultAvatar->default = false;
                }
                $avatar->default = true;
            }
            $avatar->save();
        }

        return redirect()->route('panel.avatar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function show(Avatar $avatar)
    {
        //
        return view('avatar.show', compact('avatar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function edit(Avatar $avatar)
    {
        //
        PermissionHandler::notEditMediaAbort();
        return view('avatar.edit', compact('avatar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avatar $avatar)
    {
        //
        PermissionHandler::notEditMediaAbort();

        if ($request->file('image')) {
            if (($avatar->image !== null) && !$avatar->default)
            {
                Storage::delete($avatar->image_path);
            }
            $avatar->image_path = $request->file('image')->store('public/avatars');
            $avatar->size = $request->file('image')->getSize();
            $imageresolution = getimagesize($request->file('image'));
            $avatar->resolution = "{$imageresolution[0]}x{$imageresolution[1]}";

            $avatar->save();
        }

        if (($request->default == 1) && ($avatar->default != true)) {
            $defaultAvatar = Avatar::where('default', true)->get()->first();
            if ($defaultAvatar !== null) {
                $defaultAvatar->default = false;
                $defaultAvatar->save();
            }
            $avatar->default = true;
            $avatar->save();
        }

        if (($avatar->default == true) && ($request->default === null))
        {
            $avatar->default = false;
            $avatar->save();
            AvatarCreator::defaultAvatar();
        }

        return redirect()->route('panel.avatar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avatar $avatar)
    {
        //
        PermissionHandler::notDeleteMediaAbort();

        Storage::delete($avatar->image_path);
        $avatar->delete();

        if ($avatar->default == true)
        {
            AvatarCreator::defaultAvatar();
        }
        $defaultAvatar = Avatar::where('default', true)->get()->first();
        User::where('image_id', null)->update(['image_id' => $defaultAvatar->id]);

        return redirect()->route('panel.avatar');
    }
}
