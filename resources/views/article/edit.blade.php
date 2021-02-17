@extends('layouts.panel')
@section('content')
    <div class="container-fluid" style="display: flex; justify-content: center; flex-direction: column">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Articles</h1>

        <div class="card" style="width: 80vw; align-self: center">
            <div class="card-header">Edit</div>

            <div style="height: 48vw; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                @if ($article->image !== null)
                    <a href="{{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }}">
                        <img class="card-img-top text-hide" style="align-self: center; object-fit: cover; overflow: hidden; height: 48vw" src="{{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }}" alt="Card image cap">
                    </a>
                @endif
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('article.update', $article) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label text-md-right">Select image</label>
                        <div class="col-md-6">
                            <input id="image" type="file" name="image">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label text-md-right">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $article->title }}" required autocomplete="name" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="text" class="col-md-2">Text</label>
                        <textarea id="text" name="text" rows="25" class="form-control" style="width: 100%; height: auto">{{ $article->text }}</textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>

                @if (\App\Http\Helpers\PermissionHandler::canDestroyArticles() || (\Illuminate\Support\Facades\Auth::id() === $article->user_id && \App\Http\Helpers\PermissionHandler::isWriter()))
                        <div>
                            <form method="POST" action="{{ route('article.destroy', $article) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="margin-top: 10px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
