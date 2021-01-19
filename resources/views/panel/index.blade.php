@extends('layouts.app')
@section('content')
<div class="container d-flex flex-row flex-wrap">

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <a href="{{ route('user.show', \Illuminate\Support\Facades\Auth::user()) }}">Profile</a>
    </div>
</div>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <a href="{{ route('panel.comments.user') }}">User comments</a>
    </div>
</div>

@if (\App\Http\Helpers\PermissionHandler::isWriter())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.articles.user') }}">User articles</a>
        </div>
    </div>
@endif

@if (\App\Http\Helpers\PermissionHandler::isArticleEditor())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.articles') }}">Articles</a>
        </div>
    </div>
@endif

@if (\App\Http\Helpers\PermissionHandler::isUserEditor())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.users') }}">Users</a>
        </div>
    </div>
@endif

@if (\App\Http\Helpers\PermissionHandler::isCommentEditor())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.comments') }}">Comments</a>
        </div>
    </div>
@endif

@if (\App\Http\Helpers\PermissionHandler::isRoleEditor())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.roles') }}" class="card-link">Roles</a>
        </div>
    </div>
@endif


@if (\App\Http\Helpers\PermissionHandler::isMediaEditor())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.gallery') }}" class="card-link">Gallery</a>
        </div>
    </div>
@endif


@if (\App\Http\Helpers\PermissionHandler::isMediaEditor())
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.avatar') }}" class="card-link">Avatar</a>
        </div>
    </div>
@endif

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.menu') }}" class="card-link">Menu</a>
        </div>
    </div>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <a href="{{ route('panel.menuitem') }}" class="card-link">Menu items</a>
        </div>
    </div>

</div>

@endsection
