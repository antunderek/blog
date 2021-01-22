<div class="card">
    <div style="height: 45vw; overflow: hidden; object-fit: cover; background-color: whitesmoke">
        @if ($article->image !== null)
            <img class="card-img-top text-hide" style="align-self: center; object-fit: cover; overflow: hidden; height: 45vw" src="{{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }}" alt="Card image cap">
        @endif
    </div>
    <div class="card-body">
        @if ($article->user !== null)
            <p>Author: <a href="{{ route('user.show', $article->user) }}">{{ $article->user->name }}</a>, Created at: {{ $article->created_at }}, Last updated: {{ $article->updated_at }}</p>
        @else
            <p>Author: deleted, Created at: {{ $article->created_at }}, Last updated: {{ $article->updated_at }}</p>
        @endif
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">{!! $article->text !!}</p>
    </div>
</div>
