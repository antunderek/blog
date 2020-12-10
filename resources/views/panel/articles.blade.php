@extends('layouts.app')
@section('content')
<table border="1">
    <thead>
        <th>Image</th>
        <th>Id</th>
        <th>Writer</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created at</th>
        <th>Last edited</th>
        <th>Actions</th>
    </thead>
    <tbody>
@foreach($articles as $article)
    <tr data-url="{{ route('article.show', $article) }}">
        <td>
            <img src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($article)) }}" style="width: 10vw">
        </td>
        <td><a href="{{ route('article.show', $article) }}">{{ $article->id }}</td>
        @if ($article->user_id === null)
            <td>deleted</td>
            @else
            <td><a href="{{ route('user.show', $article->user_id) }}">{{ \App\User::where('id', $article->user_id)->pluck('name')->first() }}</a></td>
        @endif
        <td><a href="{{ route('article.show', $article) }}">{{ $article->title }}</a></td>
        <td><a href="{{ route('article.show', $article) }}">{{ \Illuminate\Support\Str::limit($article->text, 150, $end="...") }}</a></td>
        <td>{{ $article->created_at }}</td>
        <td>{{ $article->updated_at }}</td>
        <td>
            <a href="{{ route('article.edit', $article) }}" class="btn btn-primary">Edit</a>
            <button>Hide</button>
            <form method="POST" action="{{ route('article.destroy', $article) }}">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-primary">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
    </tbody>
</table>
    <a href="{{ route('article.create') }}" class="btn btn-primary">New article</a>
@endsection
