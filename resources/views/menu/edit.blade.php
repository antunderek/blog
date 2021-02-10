@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('menu.update', $menu) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $menu->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="order" class="col-md-4 col-form-label text-md-right">Order</label>

                                <div class="col-md-6">
                                    <input id="order" type="number" step="1" name="order" value="{{ $menu->order }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                @foreach ($roles as $role)
                                    <label for="{{ $role->id }}" class="col-md-4 col-form-label text-md-right">{{ $role->role }}</label>

                                    <div class="col-md-6">
                                        @if ($menu->roles()->where('role_id', $role->id)->count() == 1)
                                            <input id="{{ $role->id }}" type="checkbox" checked name="roles[]" value="{{ $role->id }}">
                                        @else
                                            <input id="{{ $role->id }}" type="checkbox" name="roles[]" value="{{ $role->id }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-bottom: 10px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if (\App\Http\Helpers\PermissionHandler::canDeleteMenus())
                            <form method="POST" action="{{ route('menu.destroy', $menu) }}">
                                @csrf
                                @method('DELETE')

                                <div class="form-group row md-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-danger" style="margin-bottom: 10px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <div class="card">
                            <div style="background-color: white" class="card-header">
                                Menu items
                            </div>
                            <div class="card-body">
                                @include('includes.menu_items.show', ['items' => $menu->menuItems])
                                <a style="margin-top: 20px" href="{{ route('item.create', $menu) }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    New item
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
