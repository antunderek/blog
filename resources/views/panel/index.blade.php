
Profile
@if (\App\Http\Helpers\PermissionHandler::isWriter() || \App\Http\Helpers\PermissionHandler::isEditor())
    <a href="{{ route('panel.articles') }}">Articles</a>
@endif

@if (\App\Http\Helpers\PermissionHandler::isUserEditor())
Users
@endif
<!-- Assets, images...? -->
Comments
