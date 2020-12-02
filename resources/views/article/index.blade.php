@extends('layouts.default')
@section('content')
Index view
<a href="article/create">Create article</a>

<div style="justify-content: center; display: grid; ">
    @foreach($articles as $article)
        <a href="{{ route('article.show', $article) }}">
        <div style="width: 50vw; display: flex">
            @include('includes.article.index')
        </div>
        </a>
    @endforeach
</div>
@endsection
