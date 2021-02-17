@extends('layouts.panel')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Comments</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="User" class="col-md-4 col-form-label text-md-right">User:</label>

                            <div class="col-md-6">
                                @if ($comment->user !== null)
                                    <a href="{{ route('user.show', $comment->user) }}">{{ $comment->user->name }}</a>
                                @else
                                    <p>deleted</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="article" class="col-md-4 col-form-label text-md-right">Article id:</label>

                            <div class="col-md-6">
                                @if (App\Article::where('id', $comment->article_id)->get()->count() !== 0)
                                    <td><a href="{{ route('article.show', App\Article::where('id', $comment->article_id)->get()[0]) }}#comment-{{ $comment->id }}">{{ $comment->article_id }}</a></td>
                                @else
                                    <td>Temp deleted</td>
                                @endif
                            </div>
                        </div>

                        @if ($comment->parent_id)
                            <div class="form-group row">
                                <label for="parent" class="col-md-4 col-form-label text-md-right">Parent comment:</label>

                                <div class="col-md-6">
                                    <a id="parent" href="{{ route('comment.show', $comment->parent_id) }}">{{ $comment->parent_id }}</a>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="created" class="col-md-4 col-form-label text-md-right">Created at:</label>

                            <div class="col-md-6">
                                <p id="created">{{ $comment->created_at }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="edited" class="col-md-4 col-form-label text-md-right">Edited at:</label>

                            <div class="col-md-6">
                                <p id="edited">{{ $comment->updated_at }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">Comment:</label>

                            <div class="col-md-6">
                                <p id="comment">{{ $comment->comment }}</p>
                            </div>
                        </div>

                        @if (\App\Http\Helpers\PermissionHandler::canEditComments() || (\Illuminate\Support\Facades\Auth::id() === $comment->user_id))
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('comment.edit', $comment) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                        </svg>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
