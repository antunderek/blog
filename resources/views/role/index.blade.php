@extends('layouts.app')
@section('content')
    <table border="1">
        <thead>
        <th>Id</th>
        <th>Role</th>
        <th>Writer</th>
        <th>Edit articles</th>
        <th>Delete articles</th>
        <th>Create roles</th>
        <th>Edit roles</th>
        <th>Delete roles</th>
        <th>Create users</th>
        <th>Edit users</th>
        <th>Delete users</th>
        <th>Created at</th>
        <th>Updated at</th>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td><a href="{{ route('role.show', $role) }}">{{ $role->id }}</td>
                <td>{{ $role->role }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->writer) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->edit_article) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->delete_article) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->create_role) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->edit_role) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->delete_role) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->create_user) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->edit_user) }}</td>
                <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->delete_user) }}</td>
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
@endsection
