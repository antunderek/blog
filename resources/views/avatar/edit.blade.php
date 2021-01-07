@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('avatar.update', $avatar) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <img class="offset-md-4 my-xl-3" style="width: 128px; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($avatar->image_path, 'avatars/')) }}">

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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-6 offset-md-4" style="display: inline-flex; margin-top: 2vw">
                            <form method="POST" action="{{ route('avatar.destroy', $avatar) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
