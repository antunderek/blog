<?php

namespace App\Http\Controllers;

use App\Http\Traits\SearchTrait;
use App\Http\Traits\UserAvatarTrait;
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
    use UserAvatarTrait;
    use SearchTrait;

    public function __construct()
    {
        $this->middleware('auth')->except('show');
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

        $users = User::withTrashed()->paginate(30);
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
        $this->authorize('create', User::class);
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', User::class);
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        $registerController->callAction('register', [$request]);
        return redirect()->route('panel.users')->with('success', 'User created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
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
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $this->authorize('update', $user);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->authorize('update', $user);
        Validator::validate($request, 'user_name');

        if ($request->password !== null) {
            Validator::validate($request, 'user_password');
            $user->password = Hash::make($request->password);
        }

        if ($user->email !== $request->email) {
            Validator::validate($request, 'user_email');
            $user->email = $request->email;
        } else {
            $user->email = $request->email;
        }

        if ($request->file('image')) {
            Validator::validate($request, 'user_avatar');
            $image = new Avatar();
            $image = $this->setPathResolutionSizeAvatar($request, $image);
            $image->save();
            // delete old avatar if not default
            if ($user->image !== null) {
                if (!$user->image->default) {
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
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if ($user->email === 'superuser@email.com' && ($user->role->role === 'superuser')) {
            return redirect()->back()->with('warning', "User with the superuser@email.com email and superuser role can't be deleted.");
        }
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('panel.users')->with('success', 'User successfully soft deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function restore(string $id)
    {
        $this->authorize('restore', [User::class, $id]);
        User::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'User successfully restored.');
    }

    public function searchUsers(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $columns = ['id', 'name', 'email'];
        $query = User::withTrashed()->select();
        $users = $this->search($query, $columns, $request->keyword, true, 30);
        $currentUserRole = Role::where('id', Auth::user()->role_id)->first();
        return view('user.index', compact('users', 'currentUserRole'));
    }
}
