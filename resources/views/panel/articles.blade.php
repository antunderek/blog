@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (\Illuminate\Support\Facades\Request::routeIs('panel.articles.user*'))
                    <form method="GET" action="{{ route('panel.articles.user.search') }}" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                @else
                    <form method="GET" action="{{ route('panel.articles.search') }}" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                @endif

                <table class="table">
                    <a href="{{ route('article.create') }}" class="btn btn-primary">New article</a>
                    <thead>
                        <th>Image</th>
                        <th>Id</th>
                        <th>Writer</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Last edited</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr data-url="{{ route('article.show', $article) }}">
                            <td>
                                @if ($article->image !== null)
                                    <img src="{{ url(\App\Http\Helpers\FileHandler::getImage($article->image->image_path)) }}" style="width: 10vw">
                                @else
                                    No image
                                @endif
                            </td>
                            <td><a href="{{ route('article.show', $article) }}">{{ $article->id }}</td>
                            @if ($article->user_id === null)
                                <td>deleted</td>
                                @else
                                <td><a href="{{ route('user.show', $article->user_id) }}">{{ \App\User::where('id', $article->user_id)->pluck('name')->first() }}</a></td>
                            @endif
                            <td><a href="{{ route('article.show', $article) }}">{{ $article->title }}</a></td>
                            <td><a href="{{ route('article.show', $article) }}">{{ \Illuminate\Support\Str::limit($article->text, 150, $end="...") }}</a></td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->updated_at }}</td>
                            <td>
                                @if (!$article->trashed())
                                    <a href="{{ route('article.edit', $article) }}" class="btn btn-primary">Edit</a>

                                    <button>Hide</button>

                                    <form method="POST" action="{{ route('article.destroy', $article) }}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>

                                @else
                                    <form method="POST" action="{{ route('article.restore', $article) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('article.create') }}" class="btn btn-primary">New article</a>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
