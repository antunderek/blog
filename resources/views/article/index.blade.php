Index view
<a href="article/create">Create article</a>

<table border="1">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Text</th>
            <th>Image path</th>
            <th>Creator id</th>
            <th>Date Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->text }}</td>
                <td>{{ $article->image_path }}</td>
                <td>{{ $article->user_id }}</td>
                <td>{{ $article->created_at }}</td>
                <td><a href="{{ route('article.edit', $article) }}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
