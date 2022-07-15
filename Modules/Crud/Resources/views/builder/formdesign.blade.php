@extends('theme::backend.layouts.master')

@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('crud::builder.tab', ['active' => 'form', 'type' => 'addon'])
                            <ul class="nav nav-tabs mb-1 mt-3 nav-tabs-line" id="lineTab" role="tablist">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ url('crud/builder/form/' . $name) }}">Form
                                        Configuration </a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ url('crud/builder/subform/' . $name) }}">Sub Form </a></li>
                                <li class="nav-item"><a class="nav-link active"
                                        href="{{ url('crud/builder/formdesign/' . $name) }}">Form Layout</a></li>
                            </ul>
                            <div class="row">
                                {!! Form::open(['url' => 'crud/builder/formdesign/' . $name, 'id' => 'cruddesignform', 'class' => 'form-vertical', 'parsley-validate' => '', 'novalidate' => ' ']) !!}
                                <div class="col-md-4">
                                    <div class="mb-3 mt-3">
                                        <label class="form-label"> Number Of Block : </label>
                                        <select class="select2-select form-select" required name="column"
                                            style="width:200px;" onchange="location.href='?block='+this.value">
                                            <?php for($i=1 ; $i<5;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php if ($form_column == $i) {
                                                echo 'selected';
                                            } ?>><?php echo $i; ?>
                                                Block </option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-vertical row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Display Form As : </label>
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="format" value="def"
                                                    <?php if ($format == 'def') {
                                                        echo 'checked';
                                                    } ?>>
                                                <label class="form-check-label" for="def">
                                                    Default
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="format" value="tab"
                                                    <?php if ($format == 'tab') {
                                                        echo 'checked';
                                                    } ?> @disabled(true)>
                                                <label class="form-check-label" for="tab">
                                                    Tab <span class="badge bg-primary">Future</span>
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="format" value="column"
                                                    <?php if ($format == 'column') {
                                                        echo 'checked';
                                                    } ?> @disabled(true)>
                                                <label class="form-check-label" for="column">
                                                    Column <span class="badge bg-primary">Future</span>
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="format" value="group"
                                                    <?php if ($format == 'group') {
                                                        echo 'checked';
                                                    } ?> @disabled(true)>
                                                <label class="form-check-label" for="group">
                                                    Groupped <span class="badge bg-primary">Future</span>
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="format"
                                                    value="wizzard" <?php if ($format == 'wizzard') {
                                                        echo 'checked';
                                                    } ?> @disabled(true)>
                                                <label class="form-check-label" for="wizzard">
                                                    Wizzard / Steps <span class="badge bg-primary">Future</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin-bottom:20px; clear:both; border-bottom:dashed 1px #ddd; padding:5px;">
                                </div>
                                <div id="FormLayout" class="row">
                                    <?php
										for($i=0;$i<$form_column;$i++)
										{
										if($form_column == 4) {
											$class = 'col-md-3';
										}  elseif( $form_column ==3 ) {
											$class = 'col-md-4';
										}  elseif( $form_column ==2 ) {
											$class = 'col-md-6';
										} else {
											$class = 'col-md-12';
										}
									?>
                                    <div class="column left  <?php echo $class; ?>">
                                        <div class="mb-3">
                                            <label for="ipt" class=" "> Block Title {{ $i + 1 }}</label>
                                            <input type="type" name="title[]" class="form-control" required
                                                placeholder=" Title Block " value="<?php if (isset($title[$i])) {
                                                    echo $title[$i];
                                                } ?>" />
                                        </div>
                                        <ul class="sortable-list">
                                            <?php foreach ($forms as $rows) {
                                                if ($rows['form_group'] == $i) {
                                                    echo '<li class="sortable-item" id="' . $rows['field'] . '"> ' . $rows['label'] . ' </li>';
                                                }
                                            } ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                    <div class="clearer">&nbsp;</div>
                                    <div class="col-md-12" style="margin:10px 0;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"> Form Layout : </label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="display" value="horizontal"
                                                <?php if ($display == 'horizontal') {
                                                    echo 'checked';
                                                } ?>>
                                            <label class="form-check-label" for="horizontal">
                                                Normal
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="display" value="Normal"
                                                <?php if ($display == 'normal') {
                                                    echo 'checked';
                                                } ?>>
                                            <label class="form-check-label" for="Normal">
                                                Vertical
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="alert alert-warning"> Once you made changes on layout , please rebuild
                                            Form Files to take affect</div>
                                        <input type="hidden" name="reordering" id="reordering" value=""
                                            class="form-control" />
                                        <input type="hidden" name="id" value="{{ $row->id }}" />
                                        <button type="button" class="btn btn-xs btn-primary btn-icon-text" id="saveLayout"> Save
                                            Layout <i class="btn-icon-append" data-feather="save"></i></button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('modules/crud/vendor/parsley/parsley.css') }}">
    <style>
        .clear,
        .clearer {
            clear: both;
        }

        .clearer {
            display: block;
            font-size: 0;
            height: 0;
            line-height: 0;
        }

        .sortable-list {
            background-color: #fff;
            border: 1px solid #e9e9e9;
            list-style: none;
            margin: 0;
            min-height: 60px;
            padding: 10px;
        }

        .sortable-item {
            background-color: #f9f9f9;

            cursor: move;
            display: block;
            margin-bottom: 5px;
            padding: 5px 20px;
        }

        #containment {
            background-color: #FFA;
            height: 230px;
        }

        .placeholder {
            background-color: #ddd;
            border: 1px dashed #666;
            height: 58px;
            margin-bottom: 5px;
        }
    </style>
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
            $('#saveLayout').click(function() {
                val = getItems('#FormLayout');
                $('#reordering').val(val);
                $('#cruddesignform').submit();
            });
            $('#FormLayout .sortable-list').sortable({
                connectWith: '#FormLayout .sortable-list'
            });
            $(function() {
                $('a.addC').relCopy({});
                var formDesignForm = $('#cruddesignform');
                formDesignForm.parsley();
                formDesignForm.submit(function() {
                    if (formDesignForm.parsley().isValid()) {
                        var options = {
                            dataType: 'json',
                            beforeSubmit: function() {},
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
            })
        });

        function getItems(exampleNr) {
            var columns = [];
            $(exampleNr + ' ul.sortable-list').each(function() {
                columns.push($(this).sortable('toArray').join(','));
            });
            return columns.join('|');
        }
    </script>
@endpush
