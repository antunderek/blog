<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAvatarTrait;
use App\User;
use App\Avatar;
use App\Http\Helpers\AvatarCreator;
use App\Http\Helpers\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    use UserAvatarTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Avatar::class, 'avatar');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', Avatar::class);
        $images = Avatar::paginate(30);

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
        Validator::validate($request, 'avatar');

        $avatar = new Avatar();
        $avatar = $this->setPathResolutionSizeAvatar($request, $avatar);

        if ($request->default == 1) {
            $this->unsetDefaultAvatar();
            $avatar->default = true;
        }
        $avatar->save();

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
        Validator::validate($request, 'avatar_update');

        if ($request->file('image')) {
            if (($avatar->image_path !== null) && !$avatar->default)
            {
                Storage::delete($avatar->image_path);
            }
            $avatar = $this->setPathResolutionSizeAvatar($request, $avatar);

            $avatar->save();
        }

        // If default
        if (($request->default == 1) && ($avatar->default != true)) {
            $this->unsetDefaultAvatar();
            $avatar->default = true;
            $avatar->save();
        }

        // If no longer default avatar
        if (($request->default === null) && ($avatar->default == true))
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

    private function unsetDefaultAvatar()
    {
        $defaultAvatar = Avatar::where('default', true)->get()->first();
        if ($defaultAvatar !== null) {
            $defaultAvatar->default = false;
            $defaultAvatar->save();
        }
    }
}
