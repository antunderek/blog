@extends('layouts.panel')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('comment.update', $comment) }}">
                            @csrf
                            @method('PUT')

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
                                <label for="comment" class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <textarea id="comment" class="form-control" name="comment" rows="3" required autocomplete="comment" autofocus>{{ $comment->comment }}</textarea>
                                </div>
                            </div>

                           <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" style="display: inline-flex; margin-top: 10px">
                                @if (\Illuminate\Support\Facades\Auth::user()->role->edit_comment || ($comment->user_id === \Illuminate\Support\Facades\Auth::id()))
                                    <form method="POST" action="{{ route('comment.delete', ['comment' => $comment]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning" style="margin-right: 1vw">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                @endif

                                @if (\Illuminate\Support\Facades\Auth::user()->role->delete_comment)
                                    <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                            </svg>
                                            Destroy
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
