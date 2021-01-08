@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <br>
                <table class="table">
                    <thead>
                    <th>Id</th>
                    <th>Menu id</th>
                    <th>Parent id</th>
                    <th>Item</th>
                    <th>Link</th>
                    <th>Created at</th>
                    <th>Last edited</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><a href="{{ route('item.show', $item) }}">{{ $item->id }}</td>
                            <td><a href="{{ route('item.show', $item) }}">{{ $item->menu_id }}</a></td>
                            <td><a href="{{ route('item.show', $item) }}">{{ $item->item }}</a></td>
                            <td><a href="{{ route('item.show', $item) }}">{{ $item->link }}</a></td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <a href="{{ route('item.edit', $item) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('item.destroy', $item) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
