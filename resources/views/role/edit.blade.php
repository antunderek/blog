@extends('layouts.panel')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Roles</h1>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('role.update', $role) }}">
                            @csrf
                            @method('PUT')
                            <label for="role">Role</label>
                            <input id="title" type="role" name="role" value="{{ $role->role }}">
                            <br>

                            <table class="table">

                                <tr>
                                    <td>
                                        <label for="writer">User can create, edit and delete articles that they own:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'writer', 'value' => $role->writer])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit any article:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'edit_article', 'value' => $role->edit_article])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any article:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'delete_article', 'value' => $role->delete_article])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create a new role</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'create_role', 'value' => $role->create_role])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing roles:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'edit_role', 'value' => $role->edit_role])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any role</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'delete_role', 'value' => $role->delete_role])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create a new user</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'create_user', 'value' => $role->create_user])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing users:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'edit_user', 'value' => $role->edit_user])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any user</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'delete_user', 'value' => $role->delete_user])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing comments</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'edit_comment', 'value' => $role->edit_comment])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any comment</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'delete_comment', 'value' => $role->delete_comment])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create media</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'create_media', 'value' => $role->create_media])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing media</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'edit_media', 'value' => $role->edit_media])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete media</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'delete_media', 'value' => $role->delete_media])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create menus</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'create_menu', 'value' => $role->create_menu])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing menus</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'edit_menu', 'value' => $role->edit_menu])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete menus</label>
                                    </td>
                                    <td>
                                        @include('includes.role.edit', ['name' => 'delete_menu', 'value' => $role->delete_menu])
                                    </td>
                                </tr>

                            </table>

                            <button class='btn btn-primary' type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                                Save
                            </button>

                        </form>
                        @if (\Illuminate\Support\Facades\Auth::user()->role->delete_role)
                            <div class="form-group row md-0">
                                <form method="POST" action="{{ route('role.destroy', $role) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="col-md-6 col-md-4">
                                        <button type="submit" class="btn btn-danger" style="margin-top: 10px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
