@foreach($articles as $article)
    <div class="post-preview">
    <a href="{{ route('article.show', $article) }}">
        <h2 class="post-title">
            {{ $article->title }}
        </h2>
        <h3 class="post-subtitle">
            {!! \Illuminate\Support\Str::limit(strip_tags($article->text), 250, $end="...") !!}
        </h3>
    </a>
    <p class="post-meta">Posted by
        @if ($article->user !== null)
        <a href="{{ route('user.show', $article->user) }}">{{ $article->user->name }}</a>
        @else
            deleted
        @endif
        on  {{ $article->created_at }}</p>
</div>
<hr>
@endforeach
