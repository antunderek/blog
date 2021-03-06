@extends('layouts.panel')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Menu items</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('item.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="item" class="col-md-4 col-form-label text-md-right">Item</label>

                                <div class="col-md-6">
                                    <input id="item" type="text" class="form-control @error('item') is-invalid @enderror" name="item" value="{{ old('item') }}" required autocomplete="item" autofocus>

                                    @error('item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-md-4 col-form-label text-md-right">Link</label>

                                <div class="col-md-6">
                                    <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" required autocomplete="link" autofocus>

                                    @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if ($parent !== null)
                                <input id="parent_id" type="hidden" value="{{ $parent->id }}" name="parent_id">
                            @endif

                            <input id="menu_id" type="hidden" value="{{ $menu->id }}" name="menu_id">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
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
