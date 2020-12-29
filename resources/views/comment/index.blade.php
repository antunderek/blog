@extends('layouts.app')
@section('content')
    <table border="1">
        <thead>
        <th>Id</th>
        <th>Article id</th>
        <th>User</th>
        <th>Parent comment id</th>
        <th>Comment</th>
        <th>Created at</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <td><a href="{{ route('comment.show', $comment) }}">{{ $comment->id }}</td>
                <td><a href="{{ route('article.show', $comment->article_id) }}">{{ $comment->article_id }}</a></td>
                <td><a href="{{ route('user.show', $comment->user_id ) }}">{{ $comment->user->name }}</a></td>

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
                        <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('user.create') }}" class="btn btn-primary">New user</a>
@endsection
