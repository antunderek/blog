@extends('layouts.panel')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Avatars</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Id</th>
                                <th>Image path</th>
                                <th>Default avatar</th>
                                <th>Created at</th>
                                <th>Last edited</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $image)
                            <tr data-url="{{ route('avatar.show', $image) }}">
                                <td>
                                    <a href="{{ route('avatar.show', $image) }}">
                                        <div style="width: 100%; display: flex">
                                            <div style="height: 128px; width: 128px; overflow: hidden; object-fit: cover; background-color: whitesmoke">
                                                    <img class="card-img-top" style="align-self: center; object-fit: cover; overflow: hidden; height: 128px" src="{{ url(\App\Http\Helpers\FileHandler::getImage($image->image_path, 'avatars/')) }}">
                                            </div>
                                        </div>
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
                                    @if (\App\Http\Helpers\PermissionHandler::canEditMedia())
                                        <a href="{{ route('avatar.edit', $image) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                            </svg>
                                            Edit
                                        </a>
                                    @endif

                                    @if (\App\Http\Helpers\PermissionHandler::canDeleteMedia())
                                        <form method="POST" action="{{ route('avatar.destroy', $image) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="display: flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @if (\App\Http\Helpers\PermissionHandler::canCreateMedia())
                    <a href="{{ route('avatar.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Upload image
                    </a>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
