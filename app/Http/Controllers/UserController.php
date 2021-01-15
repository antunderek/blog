<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Avatar;
use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', User::class);

        $users = User::paginate(50);
        $currentUserRole = Role::where('id', Auth::user()->role_id)->first();
        return view('user.index', compact('users', 'currentUserRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
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
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        $registerController->callAction('register', [$request]);
        return redirect()->route('panel.users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        Validator::validate($request, 'user_name');

        if ($request->password !== null)
        {
            Validator::validate($request, 'user_password');
            $user->password = Hash::make($request->password);
        }

        if ($user->email !== $request->email)
        {
            Validator::validate($request, 'user_email');
            $user->email = $request->email;
        }
        else
        {
            $user->email = $request->email;
        }

        if ($request->file('image'))
        {
            Validator::validate($request, 'user_avatar');
            $image = new Avatar();
            $image->image_path = $request->file('image')->store('public/avatars');
            $image->save();
            // delete old avatar if not default
            if ($user->image !== null)
            {
                if(!$user->image->default)
                {
                    $user->image->delete();
                }
            }
            $user->image_id = $image->id;
        }

        $user->name = $request->name;

        if (PermissionHandler::isUserEditor()) {
            Validator::validate($request, 'user_role');
            $user->role_id = $request->role;
        }

        $user->save();

        return redirect()->route('user.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('panel.users');
    }
}
