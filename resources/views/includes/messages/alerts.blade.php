@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-secondary" role="alert">
        {{ session('info') }}
    </div>
@endif
