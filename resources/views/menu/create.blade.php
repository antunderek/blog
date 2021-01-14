@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('menu.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                                    <input id="order" type="number" step="1" name="order" value="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                @foreach ($roles as $role)
                                <label for="{{ $role->id }}" class="col-md-4 col-form-label text-md-right">{{ $role->role }}</label>

                                <div class="col-md-6">
                                    <input id="{{ $role->id }}" type="checkbox" name="roles[]" value="{{ $role->id }}">
                                </div>
                                @endforeach
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
