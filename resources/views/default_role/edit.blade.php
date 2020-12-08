<!-- Get all roles, choose default role -->
@extends('layouts.default')
@section('content')
<form method="POST" action="{{ route('role.default.update') }}">
    @csrf
    @method('PUT')
    <select id="role" name="role">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->role }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
