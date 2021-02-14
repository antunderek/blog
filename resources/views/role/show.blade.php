@extends('layouts.panel')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Show</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input id="title" type="role" name="role" value="{{ $role->role }}" disabled>
                    </div>

                    <table class="table">

                        <tr>
                            <td>
                                <label for="writer">User can create, edit and delete articles that they own:</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'writer', 'value' => $role->writer])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can edit any article:</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'show_article', 'value' => $role->edit_article])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can delete any article:</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'delete_article', 'value' => $role->delete_article])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can create a new role</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'create_role', 'value' => $role->create_role])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can edit existing roles:</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'edit_role', 'value' => $role->edit_role])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can delete any role</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'delete_role', 'value' => $role->delete_role])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can create a new user</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'create_user', 'value' => $role->create_user])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can edit existing users:</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'edit_user', 'value' => $role->edit_user])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can delete any user</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'delete_user', 'value' => $role->delete_user])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can edit existing comments</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'edit_comment', 'value' => $role->edit_comment])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can delete any comment</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'delete_comment', 'value' => $role->delete_comment])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can create media</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'create_media', 'value' => $role->create_media])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can edit existing media</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'edit_media', 'value' => $role->edit_media])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can delete media</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'delete_media', 'value' => $role->delete_media])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can create menus</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'create_menu', 'value' => $role->create_menu])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can edit existing menus</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'edit_menu', 'value' => $role->edit_menu])
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">Can delete menus</label>
                            </td>
                            <td>
                                @include('includes.role.show', ['name' => 'delete_menu', 'value' => $role->delete_menu])
                            </td>
                        </tr>

                    </table>

                    <a href="{{ route('role.edit', $role) }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                            <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                        </svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
