@extends('layouts.app')
@section('content')
    <div class="container-fluid" style="display: flex; justify-content: center; flex-direction: column; align-items: center">
        @include('includes.article.show')
        <div class="card" style="width: 80vw">
            <div class="card-body">
                <h1>Comments:</h1>
                @include('includes.comment.show', ['comments' => $article->comments])
            </div>
        </div>
        @include('includes.comment.create')
    </div>
@endsection
