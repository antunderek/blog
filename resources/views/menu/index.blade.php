@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                @include('includes.search.search', ['routeName' => 'panel.menu.search'])

                @if (\App\Http\Helpers\PermissionHandler::canCreateMenus())
                    <a href="{{ route('menu.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        New menu
                    </a>
                @endif

                <table class="table">
                    <thead>
                    <th>Id</th>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Items</th>
                    <th>Created at</th>
                    <th>Last edited</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td><a href="{{ route('menu.show', $menu) }}">{{ $menu->id }}</td>
                            <td><a href="{{ route('menu.show', $menu) }}">{{ $menu->order }}</a></td>
                            <td><a href="{{ route('menu.show', $menu) }}">{{ $menu->title }}</a></td>
                            <td>{{ \App\MenuItem::where('menu_id', $menu->id)->get()->count() }}</td>
                            <td>{{ $menu->created_at }}</td>
                            <td>{{ $menu->updated_at }}</td>
                            <td>
                                @if (\App\Http\Helpers\PermissionHandler::canEditMenus())
                                    <a href="{{ route('menu.edit', $menu) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                        </svg>
                                        Edit
                                    </a>
                                @endif

                                @if (\App\Http\Helpers\PermissionHandler::canDeleteMenus())
                                    <form method="POST" action="{{ route('menu.destroy', $menu) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
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

                @if (\App\Http\Helpers\PermissionHandler::canCreateMenus())
                    <a href="{{ route('menu.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        New menu
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
