<div class="card" style="">
    <img class="card-img-top img-fluid" style="vertical-align: center;align-self: center; object-fit: cover;" src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($article->image_path)) }}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">{!! $article->text !!}</p>
    </div>
</div>

<div class="card">
    <div style="height: 45vw; overflow: hidden; object-fit: cover">
        <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 45vw" src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($article->image_path)) }}" alt="Card image cap">
    </div>
    <div class="card-body">
        @if ($article->user !== null)
            <p>Author: {{ $article->user->name }}, Created at: {{ $article->created_at }}, Last updated: {{ $article->updated_at }}</p>
        @else
            <p>Author: deleted, Created at: {{ $article->created_at }}, Last updated: {{ $article->updated_at }}</p>
        @endif
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">{!! $article->text !!}</p>
    </div>
</div>
