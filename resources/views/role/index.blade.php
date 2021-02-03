@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                @include('includes.search.search', ['routeName' => 'panel.roles.search'])

                <table class="table">
                <thead>
                <th>Id</th>
                <th>Role</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Default</th>
                <th>Actions</th>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td><a href="{{ route('role.show', $role) }}">{{ $role->id }}</td>
                        <td><a href="{{ route('role.show', $role) }}">{{ $role->role }}</a></td>

                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>
                            @if (\App\DefaultRole::where('role_id', $role->id)->first())
                                Default role
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('role.edit', $role) }}" class="btn btn-primary">Edit</a>
                            @if ($currentUserRole->delete_role)
                            <form method="POST" action="{{ route('role.destroy', $role) }}">
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
            <a href="{{ route('role.create') }}" class="btn btn-primary">New role</a>
            <a href="{{ route('role.default') }}" class="btn btn-danger">Default role</a>
            </div>
        </div>
    </div>
@endsection
