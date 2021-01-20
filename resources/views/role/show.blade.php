@extends('layouts.app')
@section('content')
<label for="role">Role</label>
<input id="title" type="role" name="role" value="{{ $role->role }}" disabled>
<br>

<label for="writer">User can create, edit and delete articles that they own:</label>
@include('includes.role.show', ['name' => 'writer', 'value' => $role->writer])

<label for="">Can edit any article:</label>
@include('includes.role.show', ['name' => 'edit_article', 'value' => $role->edit_article])

<label for="">Can delete any article:</label>
@include('includes.role.show', ['name' => 'delete_article', 'value' => $role->delete_article])

<label for="">Can create a new role</label>
@include('includes.role.show', ['name' => 'create_role', 'value' => $role->create_role])

<label for="">Can edit existing roles:</label>
@include('includes.role.show', ['name' => 'edit_role', 'value' => $role->edit_role])

<label for="writer">Can delete any role</label>
@include('includes.role.show', ['name' => 'delete_role', 'value' => $role->delete_role])

<label for="">Can create a new user</label>
@include('includes.role.show', ['name' => 'create_user', 'value' => $role->create_user])

<label for="">Can edit existing users:</label>
@include('includes.role.show', ['name' => 'edit_user', 'value' => $role->edit_user])

<label for="">Can delete any user</label>
@include('includes.role.show', ['name' => 'delete_user', 'value' => $role->delete_user])

<label for="">Can edit existing comments</label>
@include('includes.role.create', ['name' => 'edit_comment', 'value' => $role->edit_comment])

<label for="">Can delete any comment</label>
@include('includes.role.create', ['name' => 'delete_comment', 'value' => $role->delete_comment])

<label for="">Can create media</label>
@include('includes.role.create', ['name' => 'create_media', 'value' => $role->create_media])

<label for="">Can edit existing media</label>
@include('includes.role.create', ['name' => 'edit_media', 'value' => $role->edit_media])

<label for="">Can delete media</label>
@include('includes.role.create', ['name' => 'delete_media', 'value' => $role->delete_media])

<label for="">Can create menus</label>
@include('includes.role.create', ['name' => 'create_menu', 'value' => $role->create_menu])

<label for="">Can edit existing menus</label>
@include('includes.role.create', ['name' => 'edit_menu', 'value' => $role->edit_menu])

<label for="">Can delete menus</label>
@include('includes.role.create', ['name' => 'delete_menu', 'value' => $role->delete_menu])

<a class="btn btn-primary" href="{{ route('role.edit', $role) }}">Edit</a>
@endsection
