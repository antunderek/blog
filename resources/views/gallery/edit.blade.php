@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div style="height: 24vw; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                        <a href="{{ url(\App\Http\Helpers\FileHandler::getImage($gallery->image_path)) }}">
                            <img class="card-img-top text-hide" style="align-self: center; object-fit: cover; overflow: hidden; height: 24vw" src="{{ url(\App\Http\Helpers\FileHandler::getImage($gallery->image_path)) }}" alt="Card image cap">
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('gallery.update', $gallery) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Select image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" name="image">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Image path</label>

                                <div class="col-md-6">
                                    <p>{{ $gallery->image_path}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <p>{{ $gallery->name() }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Resolution</label>

                                <div class="col-md-6">
                                    <p>{{ $gallery->resolution }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Size</label>

                                <div class="col-md-6">
                                    <p>{{ $gallery->size }}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>


                        @if (\App\Http\Helpers\PermissionHandler::canDeleteMedia())
                            <div class="form-group row md-0">
                                <div class="col-md-6 offset-md-4" style="display: inline-flex; margin-top: 10px">
                                    <form method="POST" action="{{ route('gallery.destroy', $gallery) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
