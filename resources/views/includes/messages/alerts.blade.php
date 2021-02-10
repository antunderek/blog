@if (session('success'))
    <div class="alert alert-success" role="alert" style="margin-bottom: 0">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" role="alert" style="margin-bottom: 0">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-secondary" role="alert" style="margin-bottom: 0">
        {{ session('info') }}
    </div>
@endif
