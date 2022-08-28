@props(['page', 'question'])
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
        @if (isset($this->config[$page]['elements'][$question]['choices']))
            @foreach ($this->config[$page]['elements'][$question]['choices'] as $key => $choice)
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="me-1">{{ $key + 1 }}. </div>
                            <div x-data x-init="() => {
                                $.fn.editable.defaults.mode = 'popup';
                                $.fn.editable.defaults.onblur = 'submit';
                                $($refs.q{{ $question }}).editable({
                                    showbuttons: false
                                });
                                $($refs.q{{ $question }}).on('hidden', function(e, reason) {
                                    console.log($($refs.q{{ $question }}).editable('getValue', true))
                                    let title = $($refs.q{{ $question }}).editable('getValue', true)
                                    if (title !== '') {
                                        @this.set('config.{{ $page }}.elements.{{ $question }}.choices.{{ $key }}.text', title)
                                    } else {
                                        @this.set('config.{{ $page }}.elements.{{ $question }}.choices.{{ $key }}.text', '-')
                                    }
                                });
                            }">
                                <a href="#" x-ref="q{{ $question }}" data-type="text">
                                    {{ $choice['text'] }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td width="100px">
                        <div x-data x-init="() => {
                            $.fn.editable.defaults.mode = 'popup';
                            $.fn.editable.defaults.onblur = 'submit';
                            $($refs.q{{ $question }}).editable({
                                showbuttons: false
                            });
                            $($refs.q{{ $question }}).on('hidden', function(e, reason) {
                                console.log($($refs.q{{ $question }}).editable('getValue', true))
                                let title = $($refs.q{{ $question }}).editable('getValue', true)
                                if (title !== '') {
                                    @this.set('config.{{ $page }}.elements.{{ $question }}.choices.{{ $key }}.value', title)
                                } else {
                                    @this.set('config.{{ $page }}.elements.{{ $question }}.choices.{{ $key }}.value', '-')
                                }
                            });
                        }">
                            <a href="#" x-ref="q{{ $question }}" data-type="text">
                                {{ $choice['value'] }}
                            </a>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn text-danger btn-xs btn-icon"
                            wire:click="removeRadioOption({{ $page }},{{ $question }},{{ $key }})">
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
                           @this.emit('addRadioOptions',{{ $page }},{{ $question }})
                        }">
                        Add Option
                    </label>
                </div>
            </td>
        </tr>
    </table>
</div>
