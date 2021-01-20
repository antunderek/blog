@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('role.store') }}">
    @csrf
    @method('POST')
    <label for="role">Role</label>
    <input id="title" type="text" name="role" required>
    <br>

    <label for="writer">User can create, edit and delete articles that they own:</label>
    @include('includes.role.create', ['name' => 'writer'])

    <label for="">Can edit any article:</label>
    @include('includes.role.create', ['name' => 'edit_article'])

    <label for="">Can delete any article:</label>
    @include('includes.role.create', ['name' => 'delete_article'])

    <label for="">Can create a new role</label>
    @include('includes.role.create', ['name' => 'create_role'])

    <label for="">Can edit existing roles:</label>
    @include('includes.role.create', ['name' => 'edit_role'])

    <label for="writer">Can delete any role</label>
    @include('includes.role.create', ['name' => 'delete_role'])

    <label for="">Can create a new user</label>
    @include('includes.role.create', ['name' => 'create_user'])

    <label for="">Can edit existing users:</label>
    @include('includes.role.create', ['name' => 'edit_user'])

    <label for="">Can delete any user</label>
    @include('includes.role.create', ['name' => 'delete_user'])

    <label for="">Can edit existing comments</label>
    @include('includes.role.create', ['name' => 'edit_comment'])

    <label for="">Can delete any comment</label>
    @include('includes.role.create', ['name' => 'delete_comment'])

    <label for="">Can create media</label>
    @include('includes.role.create', ['name' => 'create_media'])

    <label for="">Can edit existing media</label>
    @include('includes.role.create', ['name' => 'edit_media'])

    <label for="">Can delete media</label>
    @include('includes.role.create', ['name' => 'delete_media'])

    <label for="">Can create menus</label>
    @include('includes.role.create', ['name' => 'create_menu'])

    <label for="">Can edit existing menus</label>
    @include('includes.role.create', ['name' => 'edit_menu'])

    <label for="">Can delete menus</label>
    @include('includes.role.create', ['name' => 'delete_menu'])


    <button type="submit">
        Save
    </button>
</form>
@endsection
