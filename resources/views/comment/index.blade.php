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
                            <td><a href="{{ route('comment.show', $comment) }}">{{ $comment->comment }}</a></td>
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
