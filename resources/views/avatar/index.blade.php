@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                @include('includes.search.search', ['routeName' => 'panel.avatar.search'])

                <table class="table">
                    <a href="{{ route('avatar.create') }}" class="btn btn-primary">Upload image</a>
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
                        <tr data-url="{{ route('avatar.show', $image) }}">
                            <td>
                                <a href="{{ route('avatar.show', $image) }}">
                                    <img src="{{ url(\App\Http\Helpers\FileHandler::getImage($image->image_path, 'avatars/')) }}" style="width: 10vw">
                                </a>
                            </td>
                            <td><a href="{{ route('avatar.show', $image) }}">{{ $image->id }}</td>
                            <td><a href="{{ route('avatar.show', $image) }}">{{ $image->image_path }}</a></td>
                            <td>
                                @if ($image->default)
                                    Default
                                @endif
                            </td>
                            <td>{{ $image->created_at }}</td>
                            <td>{{ $image->updated_at }}</td>
                            <td>
                                <a href="{{ route('avatar.edit', $image) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('avatar.destroy', $image) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $images->links() }}
                <a href="{{ route('avatar.create') }}" class="btn btn-primary">Upload image</a>
            </div>
        </div>
    </div>
@endsection
