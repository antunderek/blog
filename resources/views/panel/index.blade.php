
Profile
@if (\App\Http\Helpers\PermissionHandler::isWriter() || \App\Http\Helpers\PermissionHandler::isArticleEditor())
    <a href="{{ route('panel.articles') }}">Articles</a>
@endif

@if (\App\Http\Helpers\PermissionHandler::isUserEditor())
Users
@endif
<!-- Assets, images...? -->
Comments

@if (\App\Http\Helpers\PermissionHandler::isRoleEditor())
    <a href="{{ route('panel.roles') }}">Roles</a>
@endif
