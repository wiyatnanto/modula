<div class="dropdown" x-data="{ open: false, 'model': '{{ $attributes->get('wire:model') }}', text: '{{ $attributes->get('text') }}' }">
    <button class="btn btn-secondary dropdown-toggle" :class="open ? 'show' : ''" type="button" x-on:click="open = !open">
        <span x-text="text" />
    </button>
    <div class="dropdown-menu" :class="open ? 'show' : ''" x-show="open" x-on:click.outside="open = false">
        {{ $slot }}
    </div>
</div>
