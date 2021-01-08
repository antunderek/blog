<div style="border-left: 1px solid lightgrey; padding-left: 1vw">
    @foreach($items as $item)
        <div class="card" style="display: inline-flex; flex-direction: row; padding-left: 1vw; width: 30%">
            <p>{{ $item->item }}</p>
        </div>
        <div class="card" style="display: inline-flex; flex-direction: row; padding-left: 1vw; width: 50%">
            <p><a href="{{ $item->link }}">{{ $item->link }}</a></p>
        </div>
        <a style="justify-content: end" href="{{ route('item.create', ['menu' => $menu, 'parent' => $item]) }}" class="btn btn-primary">+</a>
        <form style="display: inline-flex; flex-direction: row; justify-content: end" method="POST" action="{{ route('item.destroy', $item) }}">
            @csrf
            @method('DELETE')
            <button type="submit" style="display: flex; flex-direction: row" class="btn btn-danger">-</button>
        </form>
    @include('includes.menu_items.show', ['items' => $item->items])
@endforeach
</div>
