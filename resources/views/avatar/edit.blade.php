@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">

                        <div style="width: 100%; display: flex; margin-bottom: 20px">
                            <div class="offset-md-4" style="height: 128px; width: 128px; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                                <a href="{{ url(\App\Http\Helpers\FileHandler::getImage($avatar->image_path, 'avatars/')) }}">
                                    <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($avatar->image_path, 'avatars/')) }}">
                                </a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('avatar.update', $avatar) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Change avatar</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" name="image">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="default" class="col-md-4 col-form-label text-md-right">Default</label>

                                <div class="col-md-6">
                                    @if ($avatar->default)
                                        <input id="default" type="checkbox" name="default" value="1" checked>
                                    @else
                                        <input id="default" type="checkbox" name="default" value="1">
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

                        @if (\Illuminate\Support\Facades\Auth::user()->role->delete_media)
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" style="display: inline-flex; margin-top: 10px">
                                <form method="POST" action="{{ route('avatar.destroy', $avatar) }}">
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
