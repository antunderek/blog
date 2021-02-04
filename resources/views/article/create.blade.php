@extends('layouts.app')
@section('content')
    <div class="container-fluid" style="display: flex; justify-content: center; flex-direction: column; align-items: center">
        <div class="card" style="width: 80vw">
            <div class="card-header">Create</div>
            <div class="card-body">
                <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label text-md-right">Select image</label>
                        <div class="col-md-6">
                            <input id="image" type="file" name="image">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label text-md-right">Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="text" class="col-md-2">Text</label>
                        <textarea id="text" name="text" rows="25" class="form-control" style="width: 100%; height: auto">{{ old('text') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
