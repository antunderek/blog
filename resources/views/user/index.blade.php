@extends('layouts.app')
@section('content')
    <table border="1">
        <thead>
        <th>Image</th>
        <th>Id</th>
        <th>Username</th>
        <th>Role</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                </td>
                <td><a href="{{ route('user.show', $user) }}">{{ $user->id }}</td>
                <td><a href="{{ route('user.show', $user) }}">{{ $user->name }}</a></td>
                <td><a href="{{ route('role.show', $user->role_id) }}">{{ \App\Role::where('id', $user->role_id)->pluck('role')->first() }}</a></td>
                <td><a href="{{ route('user.show', $user) }}">{{ $user->email}}</a></td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit</a>
                    @if ($currentUserRole->delete_user)
                    <form method="POST" action="{{ route('user.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('user.create') }}" class="btn btn-primary">New user</a>
@endsection
