@include('includes.default.open')
@include('includes.default.head')

@include('includes.default.openbody')
    @include('includes.default.header')
    @yield('content')
    @include('includes.default.scripts')
@include('includes.default.closebody')

@include('includes.default.close')
