<div class="survey-wrapper">
    @if ($survey)
        <div class="survey">
            <div class="header">
                <h4>{{ $survey->name }}</h4>
                <img src="{{ asset('storage/' . $survey->bg_header) }}" class="img-header" />
            </div>
            @foreach ($survey->json[$pageIndex]['elements'] as $questionIndex => $question)
                <div class="{{ $questionClass }}" wire:key="{{ $pageIndex . '.' . $questionIndex }}">
                    @switch($question['type'])
                        @case('input')
                            <x-crud::molecules.form-control
                                name="{{ 'answers.' . $pageIndex . '.' . $questionIndex . '.' . $question['name'] }}"
                                label="{{ $question['title'] }}">
                                <x-crud::atoms.input
                                    placeholder="{{ isset($question['placeholder']) ? $question['placeholder'] : '' }}"
                                    name="{{ $question['name'] }}"
                                    wire:model="answers.{{ $pageIndex }}.{{ $questionIndex }}.{{ $question['name'] }}" />
                            </x-crud::molecules.form-control>
                        @break

                        @case('textarea')
                            <x-crud::molecules.form-control
                                name="{{ 'answers.' . $pageIndex . '.' . $questionIndex . '.' . $question['name'] }}"
                                label="{{ $question['title'] }}">
                                <x-crud::atoms.textarea
                                    placeholder="{{ isset($question['placeholder']) ? $question['placeholder'] : '' }}"
                                    name="{{ $question['name'] }}"
                                    wire:model="answers.{{ $pageIndex }}.{{ $questionIndex }}.{{ $question['name'] }}" />
                            </x-crud::molecules.form-control>
                        @break

                        @case('checkbox')
                            <x-crud::molecules.form-control
                                name="{{ 'answers.' . $pageIndex . '.' . $questionIndex . '.' . $question['name'] }}"
                                label="{{ $question['title'] }}">
                                @foreach ($question['choices'] as $key => $choice)
                                    <x-crud::atoms.checkbox label="{{ $choice['text'] }}" name="{{ $question['name'] }}"
                                        wire:model="answers.{{ $pageIndex }}.{{ $questionIndex }}.{{ $question['name'] }}.{{ $key }}"
                                        value="{{ $choice['value'] }}" wire:key="{{ $choice['value'] }}" />
                                @endforeach
                            </x-crud::molecules.form-control>
                        @break

                        @case('radio')
                            <x-crud::molecules.form-control
                                name="{{ 'answers.' . $pageIndex . '.' . $questionIndex . '.' . $question['name'] }}"
                                label="{{ $question['title'] }}">
                                @if (isset($question['choices']))
                                    @foreach ($question['choices'] as $choice)
                                        <x-crud::atoms.radio label="{{ $choice['text'] }}" name="{{ $question['name'] }}"
                                            wire:model="answers.{{ $pageIndex }}.{{ $questionIndex }}.{{ $question['name'] }}"
                                            value="{{ $choice['value'] }}" />
                                    @endforeach
                                @endif
                            </x-crud::molecules.form-control>
                        @break

                        @case('select')
                            <x-crud::molecules.form-control
                                name="{{ 'answers.' . $pageIndex . '.' . $questionIndex . '.' . $question['name'] }}"
                                label="{{ $question['title'] }}">
                                <x-crud::atoms.select2 name="{{ $question['name'] }}" closeOnSelect="true"
                                    wire:model.defer="answers.{{ $pageIndex }}.{{ $questionIndex }}.{{ $question['name'] }}"
                                    defer="false">
                                    <option></option>
                                    @if (isset($question['choices']))
                                        @foreach ($question['choices'] as $choice)
                                            <option value="{{ $choice['value'] }}">{{ $choice['text'] }}</option>
                                        @endforeach
                                    @endif
                                </x-crud::atoms.select2>
                            </x-crud::molecules.form-control>
                        @break

                        @default
                    @endswitch
                </div>
            @endforeach
            <div class="mt-3">
                @if ($pageIndex > 0 && $pageIndex <= count($config) - 1)
                    <button class="btn btn-outline-primary btn-md"
                        wire:click="$set('pageIndex', {{ $pageIndex - 1 }})">Prev</button>
                @endif
                @if ($pageIndex >= 0 && $pageIndex < count($config) - 1)
                    <button class="btn btn-primary btn-md"
                        wire:click="$set('pageIndex', {{ $pageIndex + 1 }})">Next</button>
                @endif
                @if ($pageIndex === count($config) - 1)
                    <button class="btn btn-primary btn-md" wire:click="store">Submit</button>
                @endif
            </div>
        </div>
    @endif
</div>
@push('style')
    <style>
        .is-invalid .invalid-feedback {
            display: block !important;
        }

        .survey-wrapper {
            background-color: #f6f6f6;
            background-image: radial-gradient(#b6b6b6 0.5px, #f6f6f6 0.5px);
            background-size: 10px 10px;
        }

        .survey {
            /* max-width: 640px; */
            padding: .5rem;
            padding-left: calc((100% - 640px)/2);
            padding-right: calc((100% - 640px)/2);
            margin: 0px auto;
            height: calc(100vh - 150px);
            max-height: calc(100vh - 150px);
            overflow: scroll;
        }

        .question {
            background-color: #FFFFFF;
            border: 1px solid #e9ecef;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 5px;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);
        }

        .header {
            margin-top: 10px;
        }

        .header .img-header {
            height: 120px;
            width: 100%;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .header h4 {
            margin-bottom: 10px;
        }
    </style>
@endpush
