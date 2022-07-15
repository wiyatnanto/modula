@extends('theme::backend.layouts.master')

@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('crud::builder.tab', ['active' => 'form', 'type' => $type])
                            <ul class="nav nav-tabs mb-1 mt-3 nav-tabs-line" id="lineTab" role="tablist">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ URL::to('crud/builder/form/' . $name) }}">Form Configuration </a></li>
                                <li class="nav-item"><a class="nav-link active"
                                        href="{{ URL::to('crud/builder/subform/' . $name) }}">Sub Form </a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ URL::to('crud/builder/formdesign/' . $name) }}">Form Layout</a></li>
                            </ul>
                            {!! Form::open(['url' => 'crud/builder/savesubform/' . $name, 'class' => 'form-horizontal ', 'id' => 'crudsubform']) !!}
                            <input type='text' name='master' id='master' value='{{ $row->name }}'
                                style="display:none;" />
                            <input type='text' name='id' id='id' value='{{ $row->id }}'
                                style="display:none;" />
                            <div class="mb-3 mt-3">
                                <label for="ipt" class="form-label col-md-4"> Subform Title <code>*</code></label>
                                <div class="col-md-12">
                                    {!! Form::text('title', isset($subform['title']) ? $subform['title'] : null, ['class' => 'form-control form-control-sm', 'placeholder' => '', 'required' => 'true']) !!}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ipt" class="form-label col-md-4">Sub Form Database <code>*</code></label>
                                <div class="col-md-12">
                                    <select name="table" id="table" required="true"
                                        class="form-control form-control-sm">
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ipt" class="form-label col-md-4">Sub Form Primary Key
                                    <code>*</code></label>
                                <div class="col-md-12">
                                    <select name="master_key" id="master_key" required="true"
                                        class="form-control form-control-sm">
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ipt" class="form-label col-md-4">Sub Form Relation Key
                                    <code>*</code></label>
                                <div class="col-md-12">
                                    <select name="key" id="key" required="true"
                                        class="form-control form-control-sm">
                                    </select>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Form Type </th>
                                        <th>Form Config</th>
                                        <th>Validation</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!isset($subform['data']))
                                        <tr class="clone clonedInput">
                                            <td>
                                                <select class="select2-select form-select fiel_name" name="fields[]"
                                                    required="true"></select>
                                            </td>
                                            <td>
                                                <select class="select2-select form-select form-control-xs" required="true"
                                                    name="type[]">
                                                    @foreach ($field_type_opt as $key => $val)
                                                        <option value="{{ $key }}">{{ $val }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="config[]" placeholder="Config / Attribute "
                                                    class="form-control form-control-sm" /></td>
                                            <td><input type="text" name="validation[]" placeholder="validation "
                                                    class="form-control form-control-sm" /></td>
                                            <td>
                                                <a href="#" class="btn btn-xs"
                                                    onclick="$(this).parents('.clonedInput').remove(); return false"><i
                                                        class="fa fa-minus"></i></a>
                                                <input name="counter[]" type="hidden" value="" />
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($subform['data'] as $field => $value)
                                            <tr class="clone clonedInput">
                                                <td>
                                                    <select class="select2-select form-select fiel_name_current"
                                                        name="fields[]" required="true">
                                                        @foreach ($table_fields as $f)
                                                            <option value="{{ $f }}"
                                                                @if ($field == $f) selected @endif>
                                                                {{ $f }} </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="select2-select form-select" required="true"
                                                        name="type[]">
                                                        @foreach ($field_type_opt as $key => $val)
                                                            <option value="{{ $key }}"
                                                                @if ($value['1'] == $key) selected @endif>
                                                                {{ $val }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" value="{{ $value['2'] }}" name="config[]"
                                                        placeholder="Config / Attribute "
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" value="{{ $value['3'] }}" name="validation[]"
                                                        placeholder="validation " class="form-control form-control-sm" />
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-xs"
                                                        onclick="$(this).parents('.clonedInput').remove(); return false"><i
                                                            class="fa fa-minus"></i></a>
                                                    <input name="counter[]" type="hidden" value="" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <a href="javascript:void(0)" class="btn btn-xs btn-secondary addC mt-2" rel=".clone">More
                                field </a>
                            <div class="mb-3">
                                <label for="ipt" class="form-label col-md-4"></label>
                                <div class="col-md-8">
                                    <button name="submit" type="submit" class="btn btn-xs btn-primary">Save Master
                                        Detail </button>
                                    @if (isset($subform['master_key']))
                                        <a href="{{ url('crud/builder/subformremove/' . $name) }}"
                                            class="btn btn-xs btn-danger">Remove </a>
                                    @endif
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('modules/crud/vendor/parsley/parsley.css') }}">
@endpush
@push('script')
    <script src="{{ asset('modules/crud/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('modules/crud/vendor/jquery-jcombo/jquery.jCombo.min.js') }}"></script>
    <script src="{{ asset('modules/crud/vendor/simpleclone/simpleclone.js') }}"></script>
    <script src="{{ asset('modules/crud/vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('modules/crud/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('modules/crud/vendor/jquery.form/jquery.form.min.js') }}"></script>

    <script src="{{ asset('modules/theme/backend/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendors/jquery.toast/jquery.toast.min.js') }}"></script>

    <script>
        $(function() {
            $("#table").jCombo("{{ url('crud/builder/combotable') }}", {
                selected_value: "{{ isset($subform['table']) ? $subform['table'] : null }}"
            });
            @if (isset($subform['data']))
                $("#key ").jCombo("{{ url('crud/builder/combotablefield') }}?table=", {
                    parent: "#table",
                    selected_value: "{{ isset($subform['key']) ? $subform['key'] : null }}"
                });
                $("#master_key ").jCombo("{{ url('crud/builder/combotablefield') }}?table=", {
                    parent: "#table",
                    selected_value: "{{ isset($subform['master_key']) ? $subform['master_key'] : null }}"
                });
            @else
                $("#key ,.fiel_name").jCombo("{{ url('crud/builder/combotablefield') }}?table=", {
                    parent: "#table",
                    selected_value: "{{ isset($subform['key']) ? $subform['key'] : null }}"
                });
                $("#master_key ").jCombo("{{ url('crud/builder/combotablefield') }}?table=", {
                    parent: "#table",
                    selected_value: "{{ isset($subform['master_key']) ? $subform['master_key'] : null }}"
                });
            @endif
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('a.addC').relCopy({});
            var formSubForm = $('#crudsubform');
            formSubForm.parsley();
            formSubForm.submit(function() {
                if (formSubForm.parsley().isValid()) {
                    var options = {
                        dataType: 'json',
                        beforeSubmit: function() {
                            Pace.restart()
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                $.toast({
                                    text: data.message,
                                    position: 'top-center',
                                    loaderBg: '#0bb197'
                                });
                            } else {
                                $.toast({
                                    text: 'Something error',
                                    position: 'top-center',
                                    loaderBg: '#0bb197'
                                });
                            }
                        }
                    }
                    $(this).ajaxSubmit(options);
                    return false;
                } else {
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#table').select2();
            $('#master_key').select2();
            $('#key').select2();
        })
    </script>
@endpush
