@props(['placeholder' => 'Select Date'])
<div wire:ignore>
    <div x-data="{ date: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
        const picker = flatpickr($refs.input, {
            wrap: true,
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            onChange: function(selectedDates, dateStr, instance) {
                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', dateStr)
            }
        });
    
        feather.replace()
    
        $watch('date', (value) => {
            picker.setDate(new Date(value))
        });
    }">
        <div class="input-group flatpickr" x-ref="input">
            <input {{ $attributes }} type="text" class="form-control" placeholder="{{ $placeholder }}" data-input>
            <span class="input-group-text input-group-addon" data-toggle>
                <i data-feather="calendar"></i>
            </span>
        </div>
    </div>
</div>
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
