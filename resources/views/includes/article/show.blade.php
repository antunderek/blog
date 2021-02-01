<div class="card" style="margin-top: 1vw">
    <div style="height: {{ $imgHeight }}vw; overflow: hidden; object-fit: cover; background-color: whitesmoke">
        @if ($article->image !== null)
            <img class="card-img-top text-hide" style="align-self: center; object-fit: cover; overflow: hidden; height: {{ $imgHeight }}vw" src="{{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }}" alt="Card image cap">
        @endif
    </div>
    <div class="card-body">
        <div style="display: flex; gap: 1vw">
            @if ($article->user !== null)
                <p>Author: <a href="{{ route('user.show', $article->user) }}">{{ $article->user->name }}</a>,</p>
                <p> Created at: {{ $article->created_at }},</p>
                @if ($article->updated_at != $article->created_at)
                    <p> Last updated: {{ $article->updated_at }}</p>
                @endif
            @else
                <p>Author: deleted, Created at: {{ $article->created_at }}, Last updated: {{ $article->updated_at }}</p>
            @endif
        </div>

        <h5 class="card-title">{{ $article->title }}</h5>

        @if ($description)
            <a href="{{ route('article.show', $article) }}">{!! \Illuminate\Support\Str::limit($article->text, 500, $end="...") !!}</a>
        @else
            <p class="card-text">{!! $article->text !!}</p>
        @endif
    </div>
</div>
