<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\Http\Helpers\PermissionHandler;
use App\Role;
use App\User;
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
        //PermissionHandler::notEditUsersAbort();
        $this->authorize('viewAny', User::class);

        $users = User::all();
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
        //PermissionHandler::notCreateUsersAbort();
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
        //PermissionHandler::notCreateUsersAbort();
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
        if (Auth::id() !== $user->id)
        {
            PermissionHandler::notEditUsersAbort();
        }

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
        if (Auth::id() !== $user->id)
        {
            PermissionHandler::notEditUsersAbort();
        }

        $validData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|integer',
        ]);

        if ($request->password !== null)
        {
            $passwordValid = $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->password = Hash::make($passwordValid['password']);
        }

        if ($user->email !== $request->email)
        {
            $emailValid = $request->validate([
                'email' => 'string|email|unique:users|max:255',
            ]);
            $user->email = $emailValid['email'];
        }
        else
        {
            $emailValid = $request->validate([
                'email' => 'string|email|max:255',
            ]);
            $user->email = $emailValid['email'];
        }

        if ($request->file('image'))
        {
            $imageValid = $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif'
            ]);
            $image = new Avatar();
            $image->image_path = $imageValid['image']->store('public/avatars');
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

        $user->name = $validData['name'];

        if (PermissionHandler::isUserEditor()) {
            $user->role_id = $validData['role'];
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
        if (Auth::id() !== $user->id) {
            PermissionHandler::notDeleteUsersAbort();
        }

        $user->delete();
        return redirect()->route('panel.users');
    }

    // articles() vraca article usera ako je user writer (view od article index)

}
