@props(['size' => 'lg', 'cancelButton' => true, 'submitDismiss' => false, 'title', 'preventSubmit' => null, 'submitLabel' => 'Submit', 'id'])
<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-{{ $size }} modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @if ($cancelButton)
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                        aria-label="btn-close">Cancel</button>
                @endif
                <button type="button"
                    @if ($preventSubmit !== null) wire:click.prevent="{{ $preventSubmit }}" @else  data-bs-dismiss="modal" @endif
                    class="btn btn-sm btn-primary">{{ $submitLabel }}</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(function() {
            window.addEventListener('openModal', event => {
                $('#{{ $id }}').modal('show');
            });
            window.addEventListener('closeModal', event => {
                $('#{{ $id }}').modal('hide');
            });
            $('#{{ $id }}').on('show.bs.modal', function(e) {})
            $('#{{ $id }}').on('hide.bs.modal', function(e) {
                // Livewire.emit('clear');
            })
        });
    </script>
@endpush
