@props(['size' => 'lg', 'cancelButton' => true, 'submitDismiss' => false, 'title', 'preventSubmit' => null, 'submitLabel' => 'Submit', 'id'])
<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-{{ $size }} modal-dialog-scrollable" role="document">
        <div class="modal-content">
            @if (isset($header))
                <div class="modal-header">
                    {{ $header }}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
            @endif
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if (isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
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
            $('#{{ $id }}').on('show.bs.modal', function(e) {

            })
            $('#{{ $id }}').on('hide.bs.modal', function(e) {

            })
        });
    </script>
@endpush
