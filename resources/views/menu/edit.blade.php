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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-bottom: 20px">
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div style="background-color: white" class="card-header">
                                Menu items
                            </div>
                            <div class="card-body">
                                @include('includes.menu_items.show', ['items' => $menu->menuItems])
                                <a style="margin-top: 20px" href="{{ route('item.create', $menu) }}" class="btn btn-primary">New item</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
