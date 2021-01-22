@extends('layouts.app')
@section('content')
    @if ($writer)
        <a href="article/create" class="btn btn-outline-secondary">Create article</a>
    @endif

<div class="container-fluid" style="display: flex; justify-content: center; flex-direction: column; align-items: center">

    @include('includes.search.search', ['routeName' => 'article.search'])

    @foreach($articles as $article)
        <a href="{{ route('article.show', $article) }}" style="color: inherit; text-decoration: none">
        <div style="width: 50vw">
            @include('includes.article.show')
        </div>
        </a>
    @endforeach
    {{ $articles->links() }}
</div>
@endsection
