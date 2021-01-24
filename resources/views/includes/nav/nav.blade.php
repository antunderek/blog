@foreach ($navMenus as $menu)
    @if ($menu->roles()->where('role_id', \Illuminate\Support\Facades\Auth::user()->role_id)->get()->count() !== 0)
        <li class="nav-item dropdown">
            <a id="{{ $menu->id }}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <span class="caret">{{ $menu->title }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="{{ $menu->id }}">
                @foreach($menu->menuItems as $item)
                    <a class="dropdown-item" href="{{ $item->link }}">{{ $item->item }}</a>
                    @include('includes.nav.items', ['items' => $item->items])
                @endforeach
            </div>
        </li>
    @endif
@endforeach
