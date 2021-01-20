@extends('layouts.app')
@section('content')
    @if ($writer)
        <a href="article/create" class="btn btn-outline-secondary">Create article</a>
    @endif

<div class="container-fluid" style="display: flex; justify-content: center; flex-direction: column; align-items: center">
    <form method="GET" action="{{ route('article.search') }}" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
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
