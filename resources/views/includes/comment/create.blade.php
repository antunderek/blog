<div class="card" style="width: 80vw">
    <div class="card-body">
        <h3>New comment:</h3>
        <form method="post" action="{{ route('comment.store') }}">
            @csrf
            <input id="comment" type="text" name="comment">

            <input id="article" type="hidden" name="article" value="{{ $article->id }}">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </form>
    </div>
</div>
