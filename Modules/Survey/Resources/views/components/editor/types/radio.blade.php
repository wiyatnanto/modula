@props(['pageIndex', 'questionIndex', 'question'])
<div>
    <table>
        <tr>
            <td width="300px">
                <div class="text-muted mb-2">Options</div>
            </td>
            <td colspan="2">
                <div class="text-muted mb-2">Values</div>
            </td>
        </tr>
        {{ json_encode($question) }}
        @if (count($question['choices']) > 0)
            @foreach ($question['choices'] as $key => $choice)
                <tr>
                    <td>
                        {{ count($question['choices']) }}
                        <div class="form-check mb-2">
                            <input type="radio" class="form-check-input" name="radioDefault" id="radioDefault" readonly>
                            <label class="form-check-label" for="radioDefault">
                                <x-crud::atoms.inline-edit
                                    wire:model="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.text">
                                    {{ $choice['text'] }}
                                </x-crud::atoms.inline-edit>
                            </label>
                        </div>
                    </td>
                    <td width="100px">
                        <div x-data x-init="() => {
                            $.fn.editable.defaults.mode = 'popup';
                            $.fn.editable.defaults.onblur = 'submit';
                            $($refs.q{{ $questionIndex }}).editable({
                                showbuttons: false
                            });
                            $($refs.q{{ $questionIndex }}).on('hidden', function(e, reason) {
                                console.log($($refs.q{{ $questionIndex }}).editable('getValue', true))
                                let title = $($refs.q{{ $questionIndex }}).editable('getValue', true)
                                if (title !== '') {
                                    @this.set('config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.value', title)
                                } else {
                                    @this.set('config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.value', '-')
                                }
                            });
                        }">
                            <a href="#" x-ref="q{{ $questionIndex }}" data-type="text">
                                {{ $choice['value'] }}
                            </a>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn text-danger btn-xs btn-icon"
                            wire:click="removeRadioOption({{ $pageIndex }},{{ $questionIndex }},{{ $key }})">
                            <i class="mdi mdi-close-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td>
                <div class="form-check mb-2">
                    <input type="radio" class="form-check-input" disabled>
                    <label class="form-check-label fw-bold text-primary opacity-100"
                        x-on:click="() => {
                           @this.emit('addRadioOptions',{{ $pageIndex }},{{ $questionIndex }})
                        }">
                        Add Option
                    </label>
                </div>
            </td>
        </tr>
    </table>
</div>
