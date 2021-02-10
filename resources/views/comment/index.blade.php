@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                @if (\Illuminate\Support\Facades\Request::routeIs('panel.comments.user*'))
                    @include('includes.search.search', ['routeName' => 'panel.comments.user.search'])
                @else
                    @include('includes.search.search', ['routeName' => 'panel.comments.search'])
                @endif

                <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Article id</th>
                        <th>User</th>
                        <th>Parent comment id</th>
                        <th>Comment</th>
                        <th>Created at</th>
                        <th>Last edited</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td><a href="{{ route('comment.show', $comment) }}">{{ $comment->id }}</td>
                            @if (App\Article::where('id', $comment->article_id)->get()->count() !== 0)
                                <td><a href="{{ route('article.show', App\Article::where('id', $comment->article_id)->get()[0]) }}#comment-{{ $comment->id }}">{{ $comment->article_id }}</a></td>
                            @else
                                <td>Temp deleted</td>
                            @endif
                            <td>
                                @if ($comment->user !== null)
                                    <a href="{{ route('user.show', $comment->user_id ) }}">{{ $comment->user->name }}</a>
                                @else
                                    <p>deleted</p>
                                @endif
                            </td>

                            <td>
                                @if ($comment->parent_id !== null)
                                    <a href="{{ route('comment.show', App\Comment::where('id', $comment->parent_id)->get()[0]) }}">{{ $comment->parent_id}}</a>
                                    @else
                                    null
                                @endif
                            </td>
                            <td><a href="{{ route('comment.show', $comment) }}">{{ \Illuminate\Support\Str::limit($comment->comment, 50, $end="...") }}</a></td>
                            <td>{{ $comment->created_at }}</td>
                            <td>{{ $comment->updated_at }}</td>
                            <td>
                                @if (\Illuminate\Support\Facades\Auth::user()->role->edit_comment || ($comment->user_id === \Illuminate\Support\Facades\Auth::id()))
                                    <a href="{{ route('comment.edit', $comment) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('comment.delete', ['comment' => $comment]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning">
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
