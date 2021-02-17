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
                        <form method="POST" action="{{ route('role.store') }}">
                            @csrf
                            @method('POST')
                            <label for="role">Role</label>
                            <input id="title" type="text" name="role" required>
                            <br>

                            <table class="table">

                                <tr>
                                    <td>
                                        <label for="writer">User can create, edit and delete articles that they own:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'writer'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit any article:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'edit_article'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any article:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'delete_article'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create a new role</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'create_role'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing roles:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'edit_role'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="writer">Can delete any role</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'delete_role'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create a new user</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'create_user'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing users:</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'edit_user'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any user</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'delete_user'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing comments</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'edit_comment'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete any comment</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'delete_comment'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create media</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'create_media'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing media</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'edit_media'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete media</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'delete_media'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can create menus</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'create_menu'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can edit existing menus</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'edit_menu'])
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="">Can delete menus</label>
                                    </td>
                                    <td>
                                        @include('includes.role.create', ['name' => 'delete_menu'])
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
