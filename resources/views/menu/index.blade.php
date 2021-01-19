@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('panel.menu.search') }}" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

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
                                <a href="{{ route('menu.edit', $menu) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('menu.destroy', $menu) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('menu.create') }}" class="btn btn-primary">New menu</a>
            </div>
        </div>
    </div>
@endsection
