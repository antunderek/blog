@foreach (\App\Http\Helpers\PanelPathNavigation::pathPanelCurrent() as $path => $link)
    <a href="{{ $link }}">{{ $path }}</a>
    /
@endforeach
