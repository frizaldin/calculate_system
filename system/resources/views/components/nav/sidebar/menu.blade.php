@foreach ($feature as $e)
    @if (in_array($e->id, json_decode($authority->code, true)))
        <li class="nav-item nav-item-menu @if (Route::currentRouteName() == $key) active @endif">
            <a href="{{ $url }}" class="nav-link"><i
                    class="{{ $icon ? $icon : 'iconoir-report-columns' }} menu-icon"></i><span><small>{{ $e->title }}</small></span></a>
        </li>
    @endif
@endforeach
{{-- badge --}}
{{-- <span class="badge text-bg-info ms-auto">New</span> --}}
