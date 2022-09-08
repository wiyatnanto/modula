    <div wire:key="{{ rand() }}" class="bg-white">
        {{-- <x-crud::molecules.loader /> --}}
        <div x-data x-init="() => {
            Livewire.on('reInit', () => {
                init();
            })
            init();
        
            function init() {
                $('#toolbox li').draggable({
                    appendTo: 'body',
                    helper: 'clone',
                    connectToSortable: '.page-drop'
                });
                $('.page-drop').sortable({
                    handle: '.question-handle',
                    items: 'li:not(.placeholder)',
                    placeholder: 'highlight',
                    connectWith: 'li',
                    start: function(event, ui) {
                        ui.item.toggleClass('highlight');
                    },
                    stop: function(event, ui) {
                        if (ui.item.attr('data-type')) {
                            @this.emit('addQuestion', parseInt($(event.target).attr('data-pageIndex')), ui.item.attr('data-type'), ui.item.index())
                            ui.item.replaceWith('')
                        } else {
                            @this.emit('sortQuestion', ui.item.attr('data-page'), ui.item.attr('data-index'), ui.item.index())
                        }
                        feather.replace()
                    },
                    sort: function() {
                        $(this).removeClass('ui-state-default');
                    },
                    over: function() {
                        $('.placeholder').hide();
                    },
                    out: function() {
                        if ($(this).children(':not(.placeholder)').length == 0) {
                            $('.placeholder ').show();
                        }
                    }
                });
            }
        }">
            <div class="toolbox" x-ref="toolbox">
                <div class="toolbox-nav">
                    <div class="toolbox-title text-muted">Toolboxs</div>
                    <ul id="toolbox">
                        @foreach ($tools as $tool)
                            <li data-type="{{ $tool['type'] }}"><i class="{{ $tool['icon'] }}"></i>{{ $tool['label'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="pages">
                <x-crud::molecules.tabs active="designer">
                    <x-crud::molecules.tab title="Designer" name="designer">
                        {{ json_encode($config) }}
                        <div class="toolbar d-flex pt-2 pb-2 ps-3 pe-3">
                            <div class="me-2">
                                <a href="{{ url('survey') }}" class="btn btn-inverse-light btn-xs btn-icon">
                                    <span wire:ignore><i class="btn-icon-prepend" data-feather="arrow-left"></i></span>
                                </a>
                            </div>
                            <div class="me-auto d-flex align-items-center">
                                <div class="me-1 survey-title">{{ $name }}</div>
                            </div>
                            <div>
                                <button class="btn btn-outline-success btn-icon-text btn-sm me-1"
                                    wire:click.prevent="update">
                                    <span wire:ignore><i class="btn-icon-prepend" data-feather="database"></i></span>
                                    Results <span class="badge bg-success ms-1">{{ $results_count }}</span>
                                </button>
                            </div>
                            <div><button class="btn btn-primary btn-sm btn-icon-text" wire:click.prevent="update">
                                    <span wire:ignore><i class="btn-icon-prepend" data-feather="save"></i></span>
                                    Update</button></div>
                        </div>
                        <div class="design">
                            @if (count($config) > 0)
                                @foreach ($config as $pageIndex => $page)
                                    <div class="page" wire:key="{{ $pageIndex }}">
                                        <x-crud::atoms.inline-edit wire:model="config.{{ $pageIndex }}.desc"
                                            class="page-title">
                                            {{ $page['text'] }}
                                        </x-crud::atoms.inline-edit>
                                        <x-crud::atoms.inline-edit wire:model="config.{{ $pageIndex }}.desc"
                                            class="page-desc">
                                            {{ $page['desc'] }}
                                        </x-crud::atoms.inline-edit>
                                        <ul class="page-drop" data-pageIndex="{{ $pageIndex }}">
                                            @foreach ($page['elements'] as $questionIndex => $element)
                                                <li data-page="{{ $pageIndex }}" data-index="{{ $questionIndex }}">
                                                    <div class="question">
                                                        <div class="question-handle">
                                                            <i class="mdi mdi-drag-horizontal"></i>
                                                        </div>
                                                        <x-crud::atoms.inline-edit
                                                            wire:model="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.title">
                                                            {{ $element['title'] }}
                                                        </x-crud::atoms.inline-edit>
                                                        <div class="mb-3 mt-3">
                                                            @switch($element['type'])
                                                                {{-- @case('input')
                                                                    <x-survey::editor.types.input
                                                                        placeholder="{{ isset($element['placeholder']) ? $element['placeholder'] : 'Simple Input' }}" />
                                                                @break

                                                                @case('textarea')
                                                                    <x-survey::editor.types.textarea
                                                                        placeholder="{{ isset($element['placeholder']) ? $element['placeholder'] : 'Paragraph' }}" />
                                                                @break

                                                                @case('checkbox')
                                                                    <x-survey::editor.types.checkbox page="{{ $pageIndex }}"
                                                                        question="{{ $questionIndex }}"
                                                                        wire:key="{{ 'checbox.' . $questionIndex . '.' . $pageIndex }}" />
                                                                @break --}}
                                                                @case('checkbox')
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
                                                                            @if (count($element['choices']) > 0)
                                                                                @foreach ($element['choices'] as $key => $choice)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check mb-2">
                                                                                                <input type="checkbox"
                                                                                                    class="form-check-input"readonly>
                                                                                                <label class="form-check-label">
                                                                                                    <x-crud::atoms.inline-edit
                                                                                                        wire:model="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.text">
                                                                                                        {{ $choice['text'] }}
                                                                                                    </x-crud::atoms.inline-edit>
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td width="100px">
                                                                                            <x-crud::atoms.inline-edit
                                                                                                wire:model="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.value">
                                                                                                {{ $choice['value'] }}
                                                                                            </x-crud::atoms.inline-edit>
                                                                                        </td>
                                                                                        <td>
                                                                                            <button type="button"
                                                                                                class="btn text-danger btn-xs btn-icon"
                                                                                                wire:click="removeRadioOption({{ $pageIndex }},{{ $questionIndex }},{{ $key }})">
                                                                                                <i
                                                                                                    class="mdi mdi-close-circle"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @endif
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-check mb-2">
                                                                                        <input type="radio"
                                                                                            class="form-check-input" disabled>
                                                                                        <label
                                                                                            class="form-check-label fw-bold text-primary opacity-100"
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
                                                                @break

                                                                @case('radio')
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
                                                                            @if (count($element['choices']) > 0)
                                                                                @foreach ($element['choices'] as $key => $choice)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check mb-2">
                                                                                                <input type="radio"
                                                                                                    class="form-check-input"readonly>
                                                                                                <label class="form-check-label">
                                                                                                    <x-crud::atoms.inline-edit
                                                                                                        wire:model="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.text">
                                                                                                        {{ $choice['text'] }}
                                                                                                    </x-crud::atoms.inline-edit>
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td width="100px">
                                                                                            <x-crud::atoms.inline-edit
                                                                                                wire:model="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.choices.{{ $key }}.value">
                                                                                                {{ $choice['value'] }}
                                                                                            </x-crud::atoms.inline-edit>
                                                                                        </td>
                                                                                        <td>
                                                                                            <button type="button"
                                                                                                class="btn text-danger btn-xs btn-icon"
                                                                                                wire:click="removeRadioOption({{ $pageIndex }},{{ $questionIndex }},{{ $key }})">
                                                                                                <i
                                                                                                    class="mdi mdi-close-circle"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @endif
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-check mb-2">
                                                                                        <input type="radio"
                                                                                            class="form-check-input" disabled>
                                                                                        <label
                                                                                            class="form-check-label fw-bold text-primary opacity-100"
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
                                                                @break

                                                                {{-- @case('select')
                                                                    <x-survey::editor.types.select page="{{ $pageIndex }}"
                                                                        question="{{ $questionIndex }}"
                                                                        wire:key="{{ 'select.' . $questionIndex . '.' . $pageIndex }}" />
                                                                @break --}}

                                                                @default
                                                            @endswitch
                                                        </div>
                                                        <div class="question-action d-flex">
                                                            <div class="me-auto">
                                                                <div class="question-type">
                                                                    <x-crud::atoms.select2
                                                                        name="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.type"
                                                                        wire:model.defer="config.{{ $pageIndex }}.elements.{{ $questionIndex }}.type"
                                                                        defer="false"
                                                                        wire:key="{{ $pageIndex . '.' . $questionIndex }}">
                                                                        @foreach ($tools as $tool)
                                                                            <option value="{{ $tool['type'] }}">
                                                                                {{ $tool['label'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </x-crud::atoms.select2>
                                                                </div>
                                                            </div>
                                                            <div class="me-1">
                                                                <button type="button"
                                                                    class="btn btn-inverse-light btn-xs btn-icon-text"
                                                                    wire:click="duplicateQuestion({{ $pageIndex }}, {{ $questionIndex }})">
                                                                    Duplicate
                                                                    <i
                                                                        class="btn-icon-append mdi mdi-card-multiple-outline"></i>
                                                                </button>
                                                            </div>
                                                            <div class="me-1">
                                                                <button type="button"
                                                                    class="btn btn-inverse-light btn-required {{ isset($element['isRequired']) && $element['isRequired'] ? 'required' : '' }} btn-xs btn-icon-text"
                                                                    wire:click="toggleRequired({{ $pageIndex }},{{ $questionIndex }})">
                                                                    Required
                                                                    @if (isset($element['isRequired']) && $element['isRequired'])
                                                                        <i
                                                                            class="btn-icon-append mdi mdi-toggle-switch-outline"></i>
                                                                    @else
                                                                        <i
                                                                            class="btn-icon-append mdi mdi-toggle-switch-outline"></i>
                                                                    @endif
                                                                </button>
                                                            </div>
                                                            <div class="me-1">
                                                                <button type="button"
                                                                    class="btn btn-inverse-light btn-xs btn-icon-text"
                                                                    wire:click="removeQuestion({{ $pageIndex }},{{ $questionIndex }})">
                                                                    Delete
                                                                    <i
                                                                        class="btn-icon-append mdi mdi-delete-outline"></i>
                                                                </button>
                                                            </div>
                                                            <div>
                                                                <button type="button"
                                                                    class="btn btn-inverse-light btn-xs btn-icon-text"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#questionAttributes"
                                                                    wire:click="getAttribute({{ $pageIndex }},{{ $questionIndex }})">
                                                                    Properties
                                                                    <i class="btn-icon-append mdi mdi-tune"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                            <div class="page">
                                <div class="add-question">
                                    <div class="d-flex">
                                        <div class="me-auto">
                                            <button class="btn btn-primary btn-md" wire:click="addFirstQuestion">
                                                Add Question
                                            </button>
                                        </div>
                                        <div>
                                            <div class="question-type">
                                                <x-crud::atoms.select2 name="newQuestionType"
                                                    wire:model.defer="newQuestionType" defer="false">
                                                    @foreach ($tools as $tool)
                                                        <option value="{{ $tool['type'] }}">
                                                            {{ $tool['label'] }}
                                                        </option>
                                                    @endforeach
                                                </x-crud::atoms.select2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-crud::molecules.tab>
                    <x-crud::molecules.tab title="Json Editor" name="config">
                        <livewire:survey::editor.json :slug="$slug" />
                    </x-crud::molecules.tab>
                    <x-crud::molecules.tab title="Preview" name="preview">
                        <livewire:survey::survey :slug="$slug" questionClass="question" />
                    </x-crud::molecules.tab>
                </x-crud::molecules.tabs>
            </div>
        </div>
        @include('survey::livewire.editor.attributes')
    </div>
    @push('style')
        <link href="{{ asset('modules/survey/vendor/bootstrap5-editable/css/bootstrap-editable.css') }}"
            rel="stylesheet">
        <style>
            /*  animate */

            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            @-moz-keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            @-webkit-keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            @-o-keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            @-ms-keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            .page-content>div {
                height: 100%;
            }

            .main-wrapper .page-wrapper .page-content {
                max-height: 100vh;
                padding: 0px;
            }

            .design {
                min-height: 100%;
                background-color: #f6f6f6;
                background-image: radial-gradient(#b6b6b6 0.5px, #f6f6f6 0.5px);
                background-size: 10px 10px;
                position: relative;
                height: calc(100vh - 200px);
                max-height: calc(100vh - 200px);
                overflow: scroll;
            }

            .toolbar {
                border-bottom: 1px solid #eaecef;
            }

            .toolbar .survey-title {
                font-size: 1rem;
            }

            .toolbox {
                float: left;
                width: 220px;
                padding: 20px;
                background: transparent;
                border-radius: 8px;
                animation: fadeIn .2s;
                -webkit-animation: fadeIn .2s;
                -moz-animation: fadeIn .2s;
                -o-animation: fadeIn .2s;
                -ms-animation: fadeIn .2s;
            }

            .pages {
                margin-left: 220px;
                width: -moz-available;
                /* padding: 0px 20px; */
                /* max-height: calc(100vh - 249px);
                                                                                                                                                                                                                                                                                                                                                                                                                                                overflow: scroll; */
                animation: fadeIn .2s;
                -webkit-animation: fadeIn .2s;
                -moz-animation: fadeIn .2s;
                -o-animation: fadeIn .2s;
                -ms-animation: fadeIn .2s;

                border-left: 1px solid #eaecef;
            }

            .ui-sortable-placeholder.highlight {
                height: 1px;
                max-height: 1px;
                border: 1px solid #6571ff;
                font-weight: bold;
                background-color: lightblue;
            }

            .ui-draggable-dragging {
                background-color: #ffffff !important;
                list-style-type: none !important;
                border: 1px solid #d6d6d6;
                padding: 5px 15px;
                border-radius: 4px;
            }

            /* toolbox */
            #toolbox {
                list-style-type: none !important;
                padding-left: 0px;
            }

            #toolbox li {
                padding: 5px 5px;
                color: #4d4b4b;
                cursor: default !important;
                list-style-type: none !important;
            }

            #toolbox li:hover {
                color: #000000;
            }

            #toolbox li i {
                margin-right: 5px;
                font-size: 1.2rem;
            }

            .action-save {
                position: fixed;
                bottom: 30px;
                right: 35px;
                z-index: 99999;
            }

            /* question page */
            .page-drop {
                list-style-type: none;
                padding-left: 0px;
                min-height: 200px;
                margin-bottom: 0px;
            }

            .page-drop li {
                margin-bottom: 0px;
            }

            .design {
                padding: 20px 20px;
            }

            .design .page {
                padding: 20px;
                height: auto;
                border-radius: 18px;
                border: 1px dashed #e8e8e8;
                margin-top: 10px;
                margin-bottom: 10px;
                background-color: #fdfdfd;
            }

            .design .page:first-child {
                margin-top: 0px;
            }

            .design .page-title {
                color: #000000;
            }

            .design .page-desc {
                color: #575454;
            }

            .design .page:hover {
                background-color: #f9fafd;
                border: 1px dashed #6571ff;
            }

            .design .page .page-title {
                font-size: 1.1rem;
            }

            .design .page .page-desc {
                font-size: .9rem;
                padding-bottom: 10px;
            }

            .design .page.active {
                border: 1px dashed #6571ff;
            }

            .design .add-question {
                min-height: 50px;
                width: 100%;
                border-radius: 15px;
                border: 1px solid #e9ecef;
                background-color: #ffffff;
                padding: 20px 25px;
                box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);
            }

            .design .add-question .question-type {
                min-width: 200px;
            }

            .design .question {
                min-height: 150px;
                width: 100%;
                border-radius: 15px;
                border: 1px solid #e9ecef;
                background-color: #ffffff;
                padding: 20px 25px;
                box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);
                margin-bottom: 10px;
            }

            .design .question:hover {
                border: 1px solid #6571ff;
                background-color: #ffffff;
            }

            .design .question .question-handle {
                text-align: center;
                font-size: 1.25rem;
                position: relative;
                width: 50px;
                border-radius: 4px;
                background-color: #f9f9f9;
                margin: 0 auto;
                margin-top: -15px;
            }

            .design .question-title {
                min-height: 34px;
                font-size: .95rem;
                font-weight: 500;
            }

            .design .question-title a {
                color: #000000;
                border-bottom: dashed 1px #0088cc;
            }

            .design .question a {
                color: #000000 !important;
            }

            .design .question .form-check-input:checked {
                background-color: #ffffff;
                border-color: #c3c3c3;
            }

            .design .question .form-check-input:active {
                filter: none;
            }

            .design .question .form-check-input:checked[type="radio"] {
                background-image: none;
            }

            .design .question .form-control {
                background-color: #ffffff;
            }

            .design .question-action .btn-required.required {
                color: #6571ff;
            }

            .design .question-action .question-type {
                min-width: 200px;
            }

            /* editable */
            .editable-container.editable-inline {
                width: 100%;
            }

            .editable-pre-wrapped {
                white-space: inherit;
            }

            .editable-input {
                width: 100%;
            }

            .editable-input input {
                width: 100% !important;
                border: 1px solid #6571ff !important;
            }

            .editable-input textarea {
                height: 40px;
                width: 100% !important;
            }

            a.editable-click {
                border-bottom: dashed 1px transparent !important;
            }

            a.editable-click:hover {
                border-bottom: dashed 1px #0088cc !important;
            }
        </style>
    @endpush

    @push('script')
        <script src="{{ asset('modules/survey/vendor/bootstrap5-editable/js/bootstrap-editable.min.js') }}"></script>
        <script src="{{ asset('modules/theme/backend/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    @endpush
