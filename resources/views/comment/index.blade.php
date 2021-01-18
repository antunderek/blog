@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (\Illuminate\Support\Facades\Request::routeIs('panel.comments.user*'))
                    <form method="GET" action="{{ route('panel.comments.user.search') }}" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                @else
                    <form method="GET" action="{{ route('panel.comments.search') }}" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                @endif

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
                                <td><a href="{{ route('article.show', App\Article::where('id', $comment->article_id)->get()[0]) }}">{{ $comment->article_id }}</a></td>
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
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>{{ $comment->updated_at }}</td>
                            <td>
                                <a href="{{ route('comment.edit', $comment) }}" class="btn btn-primary">Edit</a>
                                @if (\Illuminate\Support\Facades\Auth::user()->role->delete_comment || ($comment->user_id === \Illuminate\Support\Facades\Auth::id()))
                                    <form method="POST" action="{{ route('comment.delete', ['comment' => $comment]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning">Delete</button>
                                    </form>
                                @endif

                                @if (\Illuminate\Support\Facades\Auth::user()->role->delete_comment)
                                    <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Destroy</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
