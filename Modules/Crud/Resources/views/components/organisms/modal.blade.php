@props(['modalType' => 'modal-lg', 'title', 'preventSubmit' => null, 'submitLabel' => 'Submit', 'id'])
<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $modalType }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                    aria-label="btn-close">Cancel</button>
                <button type="button" wire:click.prevent="{{ $preventSubmit }}"
                    class="btn btn-sm btn-primary">{{ $submitLabel }}</button>
            </div>
        </div>
    </div>
</div>
@once
    @push('script')
        <script>
            $(function() {
                // MODAL
                window.addEventListener('openModal', event => {
                    $('#{{ $id }}').modal('show');
                });
                window.addEventListener('closeModal', event => {
                    $('#{{ $id }}').modal('hide');
                });
                $('#{{ $id }}').on('hidden.bs.modal', function(e) {
                    Livewire.emit('closeModal')
                })
            });
        </script>
    @endpush
@endonce
