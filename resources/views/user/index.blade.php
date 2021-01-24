@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <br>
                <a href="{{ route('panel.index') }}">panel</a>
                /
                <a href="{{ route('panel.users') }}">users</a>
                <br>

                @include('includes.search.search', ['routeName' => 'panel.users.search'])

                <a href="{{ route('user.create') }}" class="btn btn-primary">New user</a>
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Id</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Comments</th>
                    <th>Articles</th>
                    <th>Created at</th>
                    <th>Last edited</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if ($user->image !== null)
                                    <a href="{{ route('user.show', $user) }}">
                                        <img style="width: 128px; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($user->image->image_path, 'avatars/')) }}">
                                    </a>
                                @endif
                            </td>
                            <td><a href="{{ route('user.show', $user) }}">{{ $user->id }}</td>
                            <td><a href="{{ route('role.show', $user->role_id) }}">{{ \App\Role::where('id', $user->role_id)->pluck('role')->first() }}</a></td>
                            <td><a href="{{ route('user.show', $user) }}">{{ $user->name }}</a></td>
                            <td><a href="{{ route('user.show', $user) }}">{{ $user->email}}</a></td>
                            <td><a href="{{ route('panel.comments', $user) }}">{{ $user->comments->count()}}</a></td>
                            <td>
                                @if ($user->role->writer)
                                    <a href="{{ route('panel.articles', $user) }}">{{ $user->articles->count()}}</a>
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                @if (!$user->trashed())
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit</a>
                                    @if ($currentUserRole->delete_user)
                                    <form method="POST" action="{{ route('user.destroy', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                @else
                                    @if ($currentUserRole->delete_user)
                                        <form method="POST" action="{{ route('user.restore', $user) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">Restore</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
                <a href="{{ route('user.create') }}" class="btn btn-primary">New user</a>
            </div>
        </div>
    </div>
@endsection
