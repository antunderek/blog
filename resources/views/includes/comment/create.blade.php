<div class="card">
    <div class="card-body">
        <h5>New comment:</h5>
        <div style="margin: 1vw">
            @if (\Illuminate\Support\Facades\Auth::check())
            <form method="post" action="{{ route('comment.store') }}">
                @csrf
                <textarea id="comment" type="text" class="form-control" rows="3" name="comment"></textarea>
                <input id="article" type="hidden" name="article" value="{{ $article->id }}">
                <div style="display: flex; justify-content: end; width: 100%;">
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">
                        Post
                    </button>
                </div>
            </form>
            @else
                Login in order to post comments
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endif
        </div>
    </div>
</div>
