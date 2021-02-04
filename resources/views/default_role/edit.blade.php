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
                        <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection
