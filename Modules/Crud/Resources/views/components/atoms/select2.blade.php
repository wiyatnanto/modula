@props(['placeholder' => 'Select Roles', 'dropdownParent' => null, 'name', 'id' => null])
<div wire:ignore>
    <select {{ $attributes }} class="form-select {{ $name }} @error($name) is-invalid @enderror"
        multiple="multiple" placeholder="{{ $placeholder }}" id="{{ $id }}  style="width: 100% !important;"">
        {{ $slot }}
    </select>
</div>

@once
    @push('style')
        <style>
            .select2-container {
                width: 100% !important;
            }

            .select2-wrapper {
                position: relative,
                    top: 0px,
                    right: 100px,
            }
        </style>
    @endpush
@endonce
@once
    @push('script')
        <script>
            $(function() {
                $('#updateUser').on('hide.bs.modal', function() {
                    livewire.emit('resetInputFields');
                });
                window.addEventListener('openModalUpdate', event => {
                    alert('sss')

                    $('#updateUser').modal('show');
                    $('.form-select').select2({
                        placeholder: 'Select here',
                        dropdownParent: $('#{{ $dropdownParent }}')
                    });
                });
                window.addEventListener('closeModalUpdate', event => {
                    $('#updateUser').modal('hide');
                    livewire.emit('resetInputFields');
                });
            });
        </script>
    @endpush
@endonce
