@extends('layouts.panel')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Menus</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title:</label>

                            <div class="col-md-6">
                                <p id="title">{{ $menu->title }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="order" class="col-md-4 col-form-label text-md-right">Order:</label>

                            <div class="col-md-6">
                                <p id="order">{{ $menu->order }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            @foreach ($roles as $role)
                                <label for="{{ $role->id }}" class="col-md-4 col-form-label text-md-right">{{ $role->role }}</label>

                                <div class="col-md-6">
                                    @if ($menu->roles()->where('role_id', $role->id)->count() == 1)
                                        <input id="{{ $role->id }}" type="checkbox" checked name="roles[]" value="{{ $role->id }}" disabled>
                                    @else
                                        <input id="{{ $role->id }}" type="checkbox" name="roles[]" value="{{ $role->id }}" disabled>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if (\App\Http\Helpers\PermissionHandler::canEditMenus())
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4" style="margin-bottom: 20px">
                                    <a href="{{ route('menu.edit', $menu) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                        </svg>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div style="background-color: white" class="card-header">
                                Menu items
                            </div>

                            <div class="card-body">
                                @include('includes.menu_items.show', ['items' => $menu->menuItems])
                                @if (\App\Http\Helpers\PermissionHandler::canEditMenus())
                                    <a style="margin-top: 20px" href="{{ route('item.create', $menu) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        New item
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
