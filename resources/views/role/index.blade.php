@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table">
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
                <th>Edit comments</th>
                <th>Delete comments</th>
                <th>Edit media</th>
                <th>Delete media</th>
                <th>Create media</th>
                <th>Edit menus</th>
                <th>Delete menus</th>
                <th>Create menus</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Default</th>
                <th>Actions</th>
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
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->edit_comment) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->delete_comment) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->create_media) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->edit_media) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->delete_media) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->create_menu) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->edit_menu) }}</td>
                        <td>{{ \App\Http\Helpers\MiscellaneousMethods::booleanYesNo($role->delete_menu) }}</td>
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
