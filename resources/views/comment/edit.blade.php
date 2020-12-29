@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('comment.update', $comment) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="User" class="col-md-4 col-form-label text-md-right">User:</label>

                                <div class="col-md-6">
                                    @if ($comment->user !== null)
                                        <p>{{ $comment->user->name }}</p>
                                    @else
                                        <p>deleted</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="created" class="col-md-4 col-form-label text-md-right">Created at:</label>

                                <div class="col-md-6">
                                    <p id="created">{{ $comment->created_at }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="edited" class="col-md-4 col-form-label text-md-right">Edited at:</label>

                                <div class="col-md-6">
                                    <p id="edited">{{ $comment->updated_at }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <textarea id="comment" class="form-control" name="comment" rows="3" required autocomplete="comment" autofocus>{{ $comment->comment }}</textarea>
                                </div>
                            </div>

                           <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-6 offset-md-4" style="display: inline-flex; margin-top: 2vw">
                            @if (\Illuminate\Support\Facades\Auth::user()->role->delete_comment || ($comment->user_id === \Illuminate\Support\Facades\Auth::id()))
                                <form method="POST" action="{{ route('comment.delete', ['comment' => $comment]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning" style="margin-right: 1vw">Delete</button>
                                </form>
                            @endif

                            @if (\Illuminate\Support\Facades\Auth::user()->role->delete_comment)
                                <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Destroy</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
