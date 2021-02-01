@extends('layouts.app')
@section('content')

<h5 style="padding-left: 2vw">Profile</h5>
<div class="container d-flex flex-row flex-wrap" style="gap: 0.5vw">

    <a href="{{ route('user.show', \Illuminate\Support\Facades\Auth::user()) }}">
        <div class="card" style="width: 18rem;">
            <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>

            <div class="card-body">
                <a href="{{ route('user.show', \Illuminate\Support\Facades\Auth::user()) }}">Profile</a>
            </div>
        </div>
    </a>

    <a href="{{ route('panel.comments.user') }}">
        <div class="card" style="width: 18rem;">
            <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-chat-text" viewBox="0 0 16 16">
                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                    <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div class="card-body">
                <a href="{{ route('panel.comments.user') }}">My comments</a>
            </div>
        </div>
    </a>

    @if (\App\Http\Helpers\PermissionHandler::isWriter())
        <a href="{{ route('panel.articles.user') }}">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </div>
                <div class="card-body">
                    <a href="{{ route('panel.articles.user') }}">My articles</a>
                </div>
            </div>
        </a>
    @endif

</div>

@if (
    \App\Http\Helpers\PermissionHandler::isUserEditor()
    || \App\Http\Helpers\PermissionHandler::isArticleEditor()
    || \App\Http\Helpers\PermissionHandler::isCommentEditor()
    || \App\Http\Helpers\PermissionHandler::isRoleEditor()
)
    <hr>
    <h5 style="padding-left: 2vw">Users</h5>

    <div class="container d-flex flex-row flex-wrap" style="gap: 0.5vw">

        @if (\App\Http\Helpers\PermissionHandler::isUserEditor())
            <a href="{{ route('panel.users') }}">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h5.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('panel.users') }}">Users</a>
                    </div>
                </div>
            </a>
        @endif

        @if (\App\Http\Helpers\PermissionHandler::isCommentEditor())

            <a href="{{ route('panel.comments') }}">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-chat-text" viewBox="0 0 16 16">
                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                            <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('panel.comments') }}">Comments</a>
                    </div>
                </div>
            </a>
        @endif

        @if (\App\Http\Helpers\PermissionHandler::isArticleEditor())
            <a href="{{ route('panel.articles') }}">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('panel.articles') }}">Articles</a>
                    </div>
                </div>
            </a>
        @endif

        @if (\App\Http\Helpers\PermissionHandler::isRoleEditor())
            <a href="{{ route('panel.roles') }}" class="card-link">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('panel.roles') }}" class="card-link">Roles</a>
                    </div>
                </div>
            </a>
        @endif
    </div>
@endif

@if (\App\Http\Helpers\PermissionHandler::isMediaEditor())
    <hr>
    <h5 style="padding-left: 2vw">Media</h5>

    <div class="container d-flex flex-row flex-wrap" style="gap: 0.5vw">
        <a href="{{ route('panel.gallery') }}" class="card-link">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2h5a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                    </svg>
                </div>

                <div class="card-body">
                    <a href="{{ route('panel.gallery') }}" class="card-link">Gallery</a>
                </div>
            </div>
        </a>

        <a href="{{ route('panel.avatar') }}" class="card-link">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                    </svg>
                </div>
                <div class="card-body">
                    <a href="{{ route('panel.avatar') }}" class="card-link">Avatars</a>
                </div>
            </div>
        </a>
    </div>
@endif

@if(\App\Http\Helpers\PermissionHandler::isMenuEditor())
    <hr>
    <h5 style="padding-left: 2vw">Menu</h5>

    <div class="container d-flex flex-row flex-wrap" style="gap: 0.5vw">

        <a href="{{ route('panel.menu') }}" class="card-link">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-menu-app" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h2A1.5 1.5 0 0 1 5 1.5v2A1.5 1.5 0 0 1 3.5 5h-2A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-2zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </div>
                <div class="card-body">
                    <a href="{{ route('panel.menu') }}" class="card-link">Menu</a>
                </div>
            </div>
        </a>


        <a href="{{ route('panel.menuitem') }}" class="card-link">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top" style="display: flex; justify-content: center; padding: 2vw 0 2vw 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-list-nested" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </div>
                <div class="card-body">
                    <a href="{{ route('panel.menuitem') }}" class="card-link">Menu items</a>
                </div>
            </div>
        </a>

    </div>
@endif

@endsection
