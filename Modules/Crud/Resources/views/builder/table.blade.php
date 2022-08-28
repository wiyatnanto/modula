@extends('theme::backend.layouts.master')

@section('content')
    <?php
    $formats = [
        'date' => ['name' => 'Date', 'placeholder' => 'ex : dd-mm-yy'],
        'image' => ['name' => 'Image', 'placeholder' => 'ex : /uploads/foldername/'],
        'link' => ['name' => 'Link', 'placeholder' => 'ex : http://link.com/{id}'],
        'radio' => ['name' => 'Checkbox/Radio', 'placeholder' => 'ex : value:display,value1,display1'],
        'number' => ['name' => 'number', 'placeholder' => ''],
        'file' => ['name' => 'Files', 'placeholder' => 'ex : /uploads/foldername/'],
        'function' => ['name' => 'Function', 'placeholder' => 'ex : Class:method:{id}-{id2}'],
        'database' => ['name' => 'Lookup / Database', 'placeholder' => 'ex : tb_name:id:display_field'],
        'component' => ['name' => 'Component', 'placeholder' => 'ex : custom.status'],
    ];
    ?>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('crud::builder.tab', ['active' => 'table', 'type' => $type])
                            {!! Form::open(['url' => 'crud/builder/savetable/' . $name, 'class' => 'form-horizontal', 'id' => 'crudtable']) !!}
                            <table class="table mt-3" id="table">
                                <thead class="no-border">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Field</th>
                                        <th scope="col" width="70" style="display: none;"> Limit</th>
                                        <th scope="col" data-hide="phone">Title / Caption </th>
                                        <th scope="col" data-hide="phone">Show</th>
                                        <th scope="col" data-hide="phone">VD </th>
                                        <th scope="col" data-hide="phone">ST</th>
                                        <th scope="col" data-hide="phone">DW</th>
                                        <th scope="col" data-hide="phone" style="width:70px;">Width</th>
                                        <th scope="col" data-hide="phone" style="width:100px;">Align</th>
                                        <th scope="col" data-hide="phone"> Format As </th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x no-border-y">
                                    <?php usort($tables, 'SiteHelpers::_sort'); ?>
                                    <?php $num=0; foreach($tables as $rows){
																	$id = ++$num;
															  ?>
                                    <tr>
                                        <td class="index"><?php echo $id; ?></td>

                                        <td><strong><?php echo $rows['field']; ?></strong>
                                            <input type="hidden" name="field[<?php echo $id; ?>]" id="field"
                                                value="<?php echo $rows['alias']; ?>" />
                                        </td>
                                        <td style="display: none;">
                                            <?php
                                            $limited_to = isset($rows['limited']) ? $rows['limited'] : '';
                                            ?>
                                            <input type="text" class="form-control form-control-sm" width="40"
                                                name="limited[<?php echo $id; ?>]" class="limited"
                                                value="<?php echo $limited_to; ?>" style="width: 30px" />

                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">EN</span>
                                                <input name="label[<?php echo $id; ?>]" type="text"
                                                    class="form-control form-control-sm " id="label"
                                                    value="<?php echo $rows['label']; ?>" aria-describedby="basic-addon1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkChecked"
                                                    name="view[<?php echo $id; ?>]" type="checkbox" id="view"
                                                    value="1" class="minimal-green" <?php if ($rows['view'] == 1) {
                                                        echo 'checked="checked"';
                                                    } ?> />
                                                <label class="form-check-label" for="checkChecked">

                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkChecked"
                                                    name="detail[<?php echo $id; ?>]" type="checkbox" id="detail"
                                                    value="1" class="minimal-green" <?php if ($rows['detail'] == 1) {
                                                        echo 'checked="checked"';
                                                    } ?> />
                                                <label class="form-check-label" for="checkChecked">

                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkChecked"
                                                    name="sortable[<?php echo $id; ?>]" type="checkbox" id="sortable"
                                                    value="1" class="minimal-green" <?php if ($rows['sortable'] == 1) {
                                                        echo 'checked="checked"';
                                                    } ?> />
                                                <label class="form-check-label" for="checkChecked">

                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkChecked"
                                                    name="download[<?php echo $id; ?>]" type="checkbox" id="download"
                                                    value="1" class="minimal-green" <?php if ($rows['download'] == 1) {
                                                        echo 'checked="checked"';
                                                    } ?> />
                                                <label class="form-check-label" for="checkChecked">

                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                name="width[<?php echo $id; ?>]" value="<?php echo $rows['width']; ?>" />
                                        </td>
                                        <td>
                                            <?php $aligns = ['left', 'center', 'right']; ?>
                                            <select class="form-control form-control-sm"
                                                name="align[<?php echo $id; ?>]">
                                                <?php foreach ($aligns as $al) { ?>
                                                <option value="<?php echo $al; ?>" <?php if (isset($rows['align']) && $rows['align'] == $al) {
                                                    echo 'selected';
                                                } ?>>
                                                    <?php echo ucwords($al); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button type="button"
                                                        class="btn btn-sm btn-secondary dropdown-toggle me-2"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        @if ($rows['format_as'] != '')
                                                            {{ $rows['format_as'] }}
                                                        @else
                                                            Format
                                                        @endif
                                                    </button>
                                                    <ul class="dropdown-menu format-option">
                                                        @foreach ($formats as $key => $val)
                                                            <a class="dropdown-item" href="javascript://void"
                                                                code="{{ $val['placeholder'] }}"
                                                                value="{{ $key }}"
                                                                onid="{{ $id }}">{{ $val['name'] }}</a>
                                                        @endforeach
                                                        <a class="dropdown-item" href="javascript://void" value="Format"
                                                            code="Unformated" onid="{{ $id }}"> Format </a>
                                                    </ul>
                                                </div><!-- /btn-group -->
                                                <input type="text" name="format_value[<?php echo $id; ?>]"
                                                    id="format_value-{{ $id }}" value="<?php if (isset($rows['format_value'])) {
                                                        echo $rows['format_value'];
                                                    } ?>"
                                                    class="form-control form-control-sm" placeholder="Unformated">
                                                <input type="hidden" name="format_as[<?php echo $id; ?>]"
                                                    id="format_as-{{ $id }}" value="{{ $rows['format_as'] }}">
                                            </div><!-- /input-group -->
                                            <a href="javascript://ajax" data-html="true" class="text-success format_info"
                                                data-toggle="popover" title="Example Usage"
                                                data-content="  <b>Data </b> = dd-yy-mm <br /> <b>Image</b> = /uploads/path_to_upload <br />  <b>Link </b> = http://domain.com ? <br /> <b> Function </b> = class|method|params <br /> <b>Checkbox</b> = value:Display,...<br /> <b>Database</b> = table|id|field <br /><br /> All Field are accepted using tag {FieldName} . Example {<b><?php echo $rows['field']; ?></b>} "
                                                data-placement="left">
                                                <i class="fa fa-question-circles	"></i>
                                            </a>
                                            <input type="hidden" name="frozen[<?php echo $id; ?>]"
                                                value="<?php echo $rows['frozen']; ?>" />
                                            <input type="hidden" name="search[<?php echo $id; ?>]"
                                                value="<?php echo $rows['search']; ?>" />
                                            <input type="hidden" name="hidden[<?php echo $id; ?>]"
                                                value="<?php if (isset($rows['hidden'])) {
                                                    echo $rows['hidden'];
                                                } ?>" />
                                            <input type="hidden" name="alias[<?php echo $id; ?>]"
                                                value="<?php echo $rows['alias']; ?>" />
                                            <input type="hidden" name="field[<?php echo $id; ?>]"
                                                value="<?php echo $rows['field']; ?>" />
                                            <input type="hidden" name="sortlist[<?php echo $id; ?>]" class="reorder"
                                                value="<?php echo $rows['sortlist']; ?>" />

                                            <input type="hidden" name="conn_valid[<?php echo $id; ?>]"
                                                value="<?php if (isset($rows['conn']['valid'])) {
                                                    echo $rows['conn']['valid'];
                                                } ?>" />
                                            <input type="hidden" name="conn_db[<?php echo $id; ?>]"
                                                value="<?php if (isset($rows['conn']['db'])) {
                                                    echo $rows['conn']['db'];
                                                } ?>" />
                                            <input type="hidden" name="conn_key[<?php echo $id; ?>]"
                                                value="<?php if (isset($rows['conn']['key'])) {
                                                    echo $rows['conn']['key'];
                                                } ?>" />
                                            <input type="hidden" name="conn_display[<?php echo $id; ?>]"
                                                value="<?php if (isset($rows['conn']['display'])) {
                                                    echo $rows['conn']['display'];
                                                } ?>" />
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="infobox infobox-info fade in">
                                <button type="button" class="close" data-dismiss="alert"> x </button>
                                <b> NOTE : </b> | <b>(DW)</b> = Download | <b> (VD) </b> = View Detail | <b>( ST )</b> =
                                Sortable <br />
                                <p> <strong>Tips !</strong> Drag and drop rows to re ordering lists </p>
                            </div>
                            <button type="submit" class="btn btn-xs btn-primary btn-icon-text">Save Changes <i
                                    class="btn-icon-append" data-feather="save"></i></button>
                            <input type="hidden" name="id" value="{{ $row->id }}" />
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .xlick {
            cursor: pointer;
        }

        .popover {
            width: 600px;
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

    <script type="text/javascript">
        $(function() {

            $('.format_info').popover();
            $('.format-option a').on('click', function() {
                var selText = $(this).text();

                $(this).parents('.input-group-btn').find('.dropdown-toggle').html(selText);
                var id = $(this).attr('onid');
                var code = $(this).attr('code');
                var value = $(this).attr('value');
                $('#format_as-' + id).val(value)
                $('#format_value-' + id).attr('placeholder', code)
                if (value == 'Format') {
                    $('#format_as-' + id).val('')
                    $('#format_value-' + id).val('')
                }
            })

            var fixHelperModified = function(e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();
                    $helper.children().each(function(index) {
                        $(this).width($originals.eq(index).width())
                    });
                    return $helper;
                },
                updateIndex = function(e, ui) {
                    $('td.index', ui.item.parent()).each(function(i) {
                        $(this).html(i + 1);
                    });
                    $('.reorder', ui.item.parent()).each(function(i) {
                        $(this).val(i + 1);
                    });
                };

            $("#table tbody").sortable({
                helper: fixHelperModified,
                stop: updateIndex
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            var formTable = $('#crudtable');
            formTable.parsley();
            formTable.submit(function() {
                if (formTable.parsley().isValid()) {
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
    </script>
@endpush
