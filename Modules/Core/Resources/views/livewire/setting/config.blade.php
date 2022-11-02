<div>
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">Settings</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search" placeholder="Search Branch" />
                </div>
            </div>
        </x-slot>
    </x-crud::molecules.card>
</div>
