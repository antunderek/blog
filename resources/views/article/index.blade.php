@extends('layouts.app')
@section('content')
    @if ($writer)
        <a href="article/create" class="btn btn-outline-secondary">Create article</a>
    @endif

<div style="justify-content: center; display: grid; ">
    @foreach($articles as $article)
        <a href="{{ route('article.show', $article) }}" style="color: inherit; text-decoration: none">
        <div style="width: 50vw; display: flex">
            @include('includes.article.index')
        </div>
        </a>
    @endforeach
</div>
@endsection
