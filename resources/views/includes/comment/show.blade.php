@foreach ($comments as $comment)
    <div style="padding: 1vw">
        <div>
            {{ $comment->user->name }}
            {{ $comment->created_at }}
        </div>
        <img style="width: 64px; height: 64px" src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($comment->user->image_path, 'avatars/')) }}">
        {{ $comment->comment }}
        <form method="post" action="{{ route('comment.store') }}">
            @csrf
            <input id="comment" type="text" name="comment">

            <input id="article" type="hidden" name="article" value="{{ $article->id }}">
            <input id="parent" type="hidden" name="parent" value="{{ $comment->id }}">
            <button type="submit" class="btn btn-primary">
                Reply
            </button>
        </form>
        <div style="border-left: 1px solid" class="md-6">
            @include('includes.comment.show', ['comments' => $comment->replies])
        </div>
    </div>
@endforeach
