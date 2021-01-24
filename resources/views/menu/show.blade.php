@extends('layouts.app')
@section('content')
    <div class="container">
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

                        <div class="card">
                            <div style="background-color: white" class="card-header">
                                Menu items
                            </div>
                            <div class="card-body">
                                @include('includes.menu_items.show', ['items' => $menu->menuItems])
                                <a style="margin-top: 20px" href="{{ route('item.create', $menu) }}" class="btn btn-primary">New item</a>
                            </div>
                        </div>


                        <br>
                        <a href="{{ route('menu.edit', $menu) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
