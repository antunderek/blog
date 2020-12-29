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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
