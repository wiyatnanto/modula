@props(['title', 'name'])
<div class="tab-pane fade" :class="'{{ $name }}' === activeTab ? 'show active' : ''"
    data-title="{{ $title }}" data-name="{{ $name }}" x-show="'{{ $name }}' == activeTab">
    {{ $slot }}
</div>
