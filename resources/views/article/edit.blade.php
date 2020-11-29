Edit view
<form method="POST" action="{{ route('article.update', $article) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="title">Title</label>
    <input id="title" type="text" name="title" value="{{ $article->title }}">
    <label for="text">Text</label>
    <textarea id="text" name="text" rows="4" cols="50">{{ $article->text }}</textarea>

    <label for="image">Select an image for upload:</label>
    <img src="images/{{ $article->image_path }}">
    <input id="image" type="file" name="image">

    <button type="submit">
        Save
    </button>
</form>
