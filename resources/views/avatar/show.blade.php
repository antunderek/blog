@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">
                        <img class="offset-md-4 my-xl-3" style="width: 128px; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($avatar->image_path, 'avatars/')) }}">

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
                                <a href="{{ route('avatar.edit', $avatar) }}" class="btn btn-primary">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
