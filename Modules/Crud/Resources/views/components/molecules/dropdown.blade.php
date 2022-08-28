@props(['label' => 'Dropdown', 'openOnHover' => false])
<div class="dropdown">
    <x-crud::atoms.button size="xs" color="outline-primary" class="dropdown-toggle" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </x-crud::atoms.button>
    <div class="dropdown-menu">
        {{ $slot }}
    </div>
</div>
