@foreach($items as $item)
    <div style="padding-left: 15px">
        <a class="dropdown-item" href="{{ $item->link }}">{{ $item->item }}</a>
        @include('includes.nav.items', ['items' => $item->items])
    </div>
@endforeach
