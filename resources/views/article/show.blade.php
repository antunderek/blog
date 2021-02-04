@extends('layouts.app')
@section('content')
    <div class="container-fluid" style="display: flex; justify-content: center; flex-direction: column; align-items: center">
        <div style="width: 80vw">
            @include('includes.article.show', ['imgHeight' => 48, 'description' => false])
        </div>
        <div class="card" style="width: 80vw">
            <div class="card-body">
                <h5>Comments:</h5>
                @include('includes.comment.show', ['comments' => $article->comments])
            </div>
        </div>
        @include('includes.comment.create')

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
    </div>
@endsection
