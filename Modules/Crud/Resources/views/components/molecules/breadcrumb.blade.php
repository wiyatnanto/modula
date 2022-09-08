@props(['items'])
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        @foreach ($items as $text => $url)
            <li class="breadcrumb-item {{ request()->is(ltrim($url, '/')) ? 'active' : '' }}">
                @if (!request()->is(ltrim($url, '/')))
                    <a href="{{ url($url) }}">{{ $text }}</a>
                @else
                    {{ $text }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>
