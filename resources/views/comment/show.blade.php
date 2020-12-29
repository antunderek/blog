@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="User" class="col-md-4 col-form-label text-md-right">User:</label>

                            <div class="col-md-6">
                                <p>{{ $comment->user->name }}</p>
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
                                <p id="edited">{{ $comment->edited_at }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">Comment:</label>

                            <div class="col-md-6">
                                <p id="comment">{{ $comment->comment }}</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('comment.edit', $comment) }}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
