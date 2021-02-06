@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Default role</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('role.default.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row md-0">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Choose default role</label>
                            <div class="col-md-6">
                                <select id="role" name="role">
                                    @foreach ($roles as $role)
                                        @if (\App\DefaultRole::first()->pluck('role_id')[0] === $role->id)
                                            <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                            @else
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row md-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
