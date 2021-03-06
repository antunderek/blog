@extends('layouts.panel')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">
                            @if ($user->image !== null)
                                @if (\Illuminate\Support\Facades\Auth::check() && \App\Http\Helpers\PermissionHandler::isMediaEditor())
                                    <a href="{{ route('avatar.show', $user->image) }}">
                                        <div class="offset-md-4" style="display: flex; margin-bottom: 20px">
                                            <div style="height: 128px; width: 128px; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                                                <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($user->image->image_path, 'avatars/')) }}">
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div class="offset-md-4" style="display: flex; margin-bottom: 20px">
                                        <div style="height: 128px; width: 128px; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                                            <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($user->image->image_path, 'avatars/')) }}">
                                        </div>
                                    </div>
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


                            <div class="form-group row">
                                <label for="articles" class="col-md-4 col-form-label text-md-right">Articles</label>

                                <div class="col-md-6">
                                    @if ($user->role->writer)
                                        @if (\Illuminate\Support\Facades\Auth::check() && $user->id === \Illuminate\Support\Facades\Auth::id())
                                            <a href="{{ route('panel.articles.user') }}">{{ $user->articles->count()}}</a>
                                        @elseif (\Illuminate\Support\Facades\Auth::check() && \App\Http\Helpers\PermissionHandler::isArticleEditor())
                                            <a href="{{ route('panel.articles', $user) }}">{{ $user->articles->count()}}</a>
                                        @else
                                        <a href="{{ route('article.index', $user) }}">{{ $user->articles->count()}}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

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

                                @if (\App\Http\Helpers\PermissionHandler::canEditUsers() || (\Illuminate\Support\Facades\Auth::id() === $user->id))
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                </svg>
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
