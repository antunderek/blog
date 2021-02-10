@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">
                        <div style="width: 100%; display: flex; margin-bottom: 20px">
                            <div class="offset-md-4" style="height: 128px; width: 128px; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                                <a href="{{ url(\App\Http\Helpers\FileHandler::getImage($avatar->image_path, 'avatars/')) }}">
                                    <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($avatar->image_path, 'avatars/')) }}">
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="default" class="col-md-4 col-form-label text-md-right">Default</label>

                            <div class="col-md-6">
                                @if ($avatar->default)
                                    <input id="default" type="checkbox" name="default" value="1" checked disabled>
                                @else
                                    <input id="default" type="checkbox" name="default" value="1" disabled>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Image path</label>

                            <div class="col-md-6">
                                <p>{{ $avatar->image_path}}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <p>{{ $avatar->name() }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Resolution</label>

                            <div class="col-md-6">
                                <p>{{ $avatar->resolution }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Size</label>

                            <div class="col-md-6">
                                <p>{{ $avatar->size }}</p>
                            </div>
                        </div>


                        @if (\App\Http\Helpers\PermissionHandler::canEditMedia())
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('avatar.edit', $avatar) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                        </svg>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
