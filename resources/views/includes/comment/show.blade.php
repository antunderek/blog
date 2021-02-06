@foreach ($comments as $comment)
    <div style="padding-left: 2vw; padding-top: 1vw">
        <div style="display: flex; gap: 1vw">
            @if ($comment->user !== null)
                <a href="{{ route('user.show', $comment->user) }}">
                    <b id="comment-{{ $comment->id }}" style="padding-right: 0.5vw">{{ $comment->user->name }}</b>
                </a>
            @else
                <b style="padding-right: 1vw">deleted</b>
            @endif
            Created: {{ $comment->created_at }}
            @if ($comment->created_at != $comment->updated_at)
                <b>Edited:</b> {{ $comment->updated_at}}
            @endif

            @include('includes.comment.dropdown')
        </div>

        <div style="display: inline">
            <div style="float: left">
                @if ($comment->user !== null)
                    <img style="width: 64px; height: 64px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($comment->user->image->image_path, 'avatars/')) }}">
                @endif
            </div>
            <div style="display: inline">
                <p style="margin-left: 75px; word-wrap: break-word; margin-top: 0.5vw">{{ $comment->comment }}</p>
            </div>
        </div>

        <button class="btn dropdown" style="display: flex; margin-left: 75px" onclick="toggleForm('reply-form-{{ $comment->id }}')">Reply</button>

        <div id="reply-form-{{ $comment->id }}" style="margin-left: 75px; margin-top: 10px; display: none">
            <form method="post" action="{{ route('comment.store') }}">
                @csrf
                <div style="width: 50%">
                    <textarea id="comment" type="text" class="form-control" rows="2" name="comment"></textarea>
                </div>

                <input id="article" type="hidden" name="article" value="{{ $article->id }}">
                <input id="parent" type="hidden" name="parent" value="{{ $comment->id }}">
                <button type="submit" class="btn btn-primary" style="margin-top: 5px">
                    Post
                </button>
            </form>
        </div>

        <div style="border-left: 1px solid" class="md-6">
            @include('includes.comment.show', ['comments' => $comment->replies])
        </div>
    </div>
@endforeach
