@extends('layouts.head')
@section('content')
    <!-- Page Header -->
    @if ($article->image !== null)
        <header class="masthead" style="background-image: url({{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }})">
    @else
        <header class="masthead">
    @endif
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $article->title }}</h1>
                        <span class="meta">Posted by
                    @if ($article->user !== null)
                                <a href="{{ route('user.show', $article->user) }}">{{ $article->user->name }}</a>
                            @else
                                deleted
                            @endif
                    on  {{ $article->created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @include('includes.article.show')

            <hr>

    <div class="container" style='font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; font-size: 1rem'>
        @include('includes.comment.create')

        <div class="card" >
            <div class="card-body">
                <h5>Comments:</h5>
                @include('includes.comment.show', ['comments' => $article->comments])
            </div>
        </div>
    </div>

        <script>
            function toggleForm(id) {
                let x = document.getElementById(id);
                if (x.style.display === "none") {
                    x.style.display = "block";
                }
                else {
                    x.style.display = "none";
                }
            }
        </script>
@endsection
