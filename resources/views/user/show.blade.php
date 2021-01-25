@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">
                            @if ($user->image !== null)
                                @if (\Illuminate\Support\Facades\Auth::check() && \App\Http\Helpers\PermissionHandler::isMediaEditor())
                                    <a href="{{ route('avatar.show', $user->image) }}">
                                        <img class="offset-md-4 my-xl-3" style="width: 128px; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($user->image->image_path, 'avatars/')) }}">
                                    </a>
                                @else
                                    <img class="offset-md-4 my-xl-3" style="width: 128px; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($user->image->image_path, 'avatars/')) }}">
                                @endif
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <p>{{ $user->name }}</p>
                                </div>
                            </div>

                            @if (\Illuminate\Support\Facades\Auth::check() && (\App\Http\Helpers\PermissionHandler::isUserEditor() || ($user->id === \Illuminate\Support\Facades\Auth::id())))
                                <div class="form-group row">
                                    <label for="comments" class="col-md-4 col-form-label text-md-right">Comments</label>

                                    <div class="col-md-6">
                                        @if ($user->id === \Illuminate\Support\Facades\Auth::id())
                                            <a href="{{ route('panel.comments.user') }}">{{ $user->comments->count()}}</a>
                                        @else
                                            <a href="{{ route('panel.comments', $user) }}">{{ $user->comments->count()}}</a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($user->role->writer)
                                <div class="form-group row">
                                    <label for="articles" class="col-md-4 col-form-label text-md-right">Articles</label>

                                    <div class="col-md-6">
                                        @if (\Illuminate\Support\Facades\Auth::check() && $user->id === \Illuminate\Support\Facades\Auth::id())
                                            <a href="{{ route('panel.articles.user') }}">{{ $user->articles->count()}}</a>
                                        @elseif (\Illuminate\Support\Facades\Auth::check() && \App\Http\Helpers\PermissionHandler::isArticleEditor())
                                            <a href="{{ route('panel.articles', $user) }}">{{ $user->articles->count()}}</a>
                                        @else
                                            <a href="{{ route('article.index', $user) }}">{{ $user->articles->count()}}</a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        @if (\Illuminate\Support\Facades\Auth::check() && (\App\Http\Helpers\PermissionHandler::isUserEditor() || ($user->id === \Illuminate\Support\Facades\Auth::id())))
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>

                                <div class="col-md-6">
                                    <p>{{ \App\Role::where('id', $user->role_id)->pluck('role')[0] }}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">
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
