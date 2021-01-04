@extends('layouts.app')
@section('content')
    <table border="1">
        <thead>
        <th>Image</th>
        <th>Id</th>
        <th>Image path</th>
        <th>Default avatar</th>
        <th>Created at</th>
        <th>Last edited</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($images as $image)
            <tr data-url="{{ route('gallery.show', $image) }}">
                <td>
                    <img src="{{ url(\App\Http\Helpers\FileHandler::returnImagePublicPath($image->image_path)) }}" style="width: 10vw">
                </td>
                <td><a href="{{ route('gallery.show', $image) }}">{{ $image->id }}</td>
                <td><a href="{{ route('gallery.show', $image) }}">{{ $image->image_path }}</a></td>
                <td>
                    @if ($image->default_avatar)
                        Default
                    @endif
                </td>
                <td>{{ $image->created_at }}</td>
                <td>{{ $image->updated_at }}</td>
                <td>
                    <a href="{{ route('gallery.edit', $image) }}" class="btn btn-primary">Edit</a>
                    <button>Hide</button>
                    <form method="POST" action="{{ route('gallery.destroy', $image) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('gallery.create') }}" class="btn btn-primary">New article</a>
@endsection
