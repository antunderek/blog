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

                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    New user
                </a>
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
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                    </svg>
                                    Edit
                                </a>
                                    @if ($currentUserRole->delete_user)
                                    <form method="POST" action="{{ route('user.destroy', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            Delete
                                        </button>
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
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    New user
                </a>
            </div>
        </div>
    </div>
@endsection
