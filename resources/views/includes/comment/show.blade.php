@foreach ($comments as $comment)
    <div style="padding: 1vw">
        <div>
            @if ($comment->user !== null)
                <b style="padding-right: 1vw">{{ $comment->user->name }}</b>
            @else
                <b style="padding-right: 1vw">deleted<b>
            @endif
            {{ $comment->created_at }}
            @if ($comment->created_at != $comment->updated_at)
                Edited: {{ $comment->updated_at}}
            @endif
        </div>
        @if ($comment->user !== null)
            <img style="width: 64px; height: 64px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($comment->user->image->image_path, 'avatars/')) }}">
        @endif
        {{ $comment->comment }}
        @if (\Illuminate\Support\Facades\Auth::user())
            @if (\Illuminate\Support\Facades\Auth::user()->role->delete_comment || ($comment->user_id === \Illuminate\Support\Facades\Auth::id()))
                <form method="POST" action="{{ route('comment.delete', ['comment' => $comment]) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning">Delete</button>
                </form>
            @endif
        @endif
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
