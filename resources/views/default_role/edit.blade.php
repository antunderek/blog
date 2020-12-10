<!-- Get all roles, choose default role -->
@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('role.default.update') }}">
    @csrf
    @method('PUT')
    <select id="role" name="role">
        @foreach ($roles as $role)
            @if (\App\DefaultRole::first()->pluck('role_id')[0] === $role->id)
                <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                @else
                <option value="{{ $role->id }}">{{ $role->role }}</option>
            @endif
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
