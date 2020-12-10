@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <label for="title">Title</label>
    <input id="title" type="text" name="title">
    <label for="text">Text</label>
    <textarea id="text" name="text" rows="4" cols="50"></textarea>

    <label for="image">Select an image for upload:</label>
    <input id="image" type="file" name="image">

    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection
