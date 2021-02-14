@extends('layouts.panel')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Articles</h1>

        @if (\App\Http\Helpers\PermissionHandler::isWriter())
            <a href="{{ route('article.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                New article
            </a>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Id</th>
                            <th>Writer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Last edited</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr data-url="{{ route('article.show', $article) }}">
                                <td>
                                    @if ($article->image !== null)
                                        <a href="{{ route('article.show', $article) }}">
                                            <img src="{{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }}" style="width: 10vw">
                                        </a>
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td><a href="{{ route('article.show', $article) }}">{{ $article->id }}</td>
                                @if ($article->user_id === null)
                                    <td>deleted</td>
                                    @else
                                    <td><a href="{{ route('user.show', $article->user_id) }}">{{ \App\User::where('id', $article->user_id)->pluck('name')->first() }}</a></td>
                                @endif
                                <td><a href="{{ route('article.show', $article) }}">{{ $article->title }}</a></td>
                                <td><a href="{{ route('article.show', $article) }}">{{ \Illuminate\Support\Str::limit(strip_tags($article->text), 50, $end="...") }}</a></td>
                                <td>{{ $article->created_at }}</td>
                                <td>{{ $article->updated_at }}</td>
                                <td>
                                    @if (!$article->trashed())
                                        @if (\App\Http\Helpers\PermissionHandler::canEditArticles() || (\Illuminate\Support\Facades\Auth::id() === $article->user_id && \App\Http\Helpers\PermissionHandler::isWriter()))
                                            <a href="{{ route('article.edit', $article) }}" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                </svg>
                                                Edit
                                            </a>
                                        @endif

                                        @if (\App\Http\Helpers\PermissionHandler::canDestroyArticles() || (\Illuminate\Support\Facades\Auth::id() === $article->user_id && \App\Http\Helpers\PermissionHandler::isWriter()))
                                            <form method="POST" action="{{ route('article.destroy', $article) }}">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                    @else
                                        @if (\App\Http\Helpers\PermissionHandler::canDestroyArticles())
                                            <form method="POST" action="{{ route('article.restore', $article) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                                    </svg>
                                                    Restore
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
