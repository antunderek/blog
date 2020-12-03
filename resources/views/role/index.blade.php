@extends('layouts.default')
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
                    <a href="{{ route('role.edit', $role) }}" class="btn btn-primary">Edit</a>
                    <button>Hide</button>
                    <form method="POST" action="{{ route('role.destroy', $role) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
