@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('panel.gallery.search') }}" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <table class="table">
                    <a href="{{ route('gallery.create') }}" class="btn btn-primary">Upload image</a>
                    <thead>
                    <th>Image</th>
                    <th>Id</th>
                    <th>Image path</th>
                    <th>Created at</th>
                    <th>Last edited</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($images as $image)
                        <tr data-url="{{ route('gallery.show', $image) }}">
                            <td>
                                <img src="{{ url(\App\Http\Helpers\FileHandler::getImage($image->image_path)) }}" style="width: 10vw">
                            </td>
                            <td><a href="{{ route('gallery.show', $image) }}">{{ $image->id }}</td>
                            <td><a href="{{ route('gallery.show', $image) }}">{{ $image->image_path }}</a></td>
                            <td>{{ $image->created_at }}</td>
                            <td>{{ $image->updated_at }}</td>
                            <td>
                                <div style="display: flex; flex-direction: row">
                                    <a href="{{ route('gallery.edit', $image) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('gallery.destroy', $image) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $images->links() }}
                <a href="{{ route('gallery.create') }}" class="btn btn-primary">Upload image</a>
            </div>
        </div>
    </div>

@endsection
