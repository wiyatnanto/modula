@extends('theme::backend.layouts.master')

@section('content')
<div class="tab-content">
    <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('crud::builder.tab',array('active'=>'form','type'=>$type))
                        <ul class="nav nav-tabs mb-1 mt-3 nav-tabs-line" id="lineTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="{{ URL::to('crud/builder/form/'.$name)}}">Form Configuration </a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('crud/builder/subform/'.$name)}}">Sub Form </a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('crud/builder/formdesign/'.$name)}}">Form Layout</a></li>
                        </ul>
                        {!! Form::open(array('url'=>'crud/builder/saveform/'.$name, 'class'=>'form-horizontal','id'=>'crudform')) !!}
                        <table class="table table-hover" id="table">
                            <thead class="no-border">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Field</th>
                                    <th scope="col" width="70" style="display: none;"> Limit</th>
                                    <th scope="col" data-hide="phone">Show</th>
                                    <th scope="col" data-hide="phone">Searchable</th>
                                    <th scope="col" data-hide="phone">Type </th>
                                    <th scope="col" data-hide="phone">Validation</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody class="no-border-x no-border-y">
                                <?php usort($forms, "SiteHelpers::_sort"); ?>
                                <?php $i=0; foreach($forms as $rows){
		  $id = ++$i;
		  ?>
                                <tr>
                                    <td class="index"><?php echo $id;?></td>
                                    <td><?php echo $rows['field'];?></td>
                                    <td style="display: none;">
                                        <?php
					 $limited_to = (isset($rows['limited']) ? $rows['limited'] : '');
				?>
                                        <input type="text" class="form-control form-control-sm" name="limited[<?php echo $id;?>]" class="limited" value="<?php echo $limited_to;?>" />

                                    </td>
                                    <td>
                                    	<div class="form-check mb-2">
																			    <input type="checkbox" class="form-check-input" id="checkChecked" name="view[<?php echo $id;?>]" value="1" class="minimal-green" <?php if($rows['view'] == 1) echo 'checked="checked"';?> />
																			    <label class="form-check-label" for="checkChecked">
																			        
																			    </label>
																			</div>
                                    </td>
                                    <td>
                                    	<div class="form-check mb-2">
																			    <input type="checkbox" class="form-check-input" id="checkChecked" name="search[<?php echo $id;?>]" value="1" class="minimal-green" <?php if($rows['search'] == 1) echo 'checked="checked"';?> />
																			    <label class="form-check-label" for="checkChecked">
																			        
																			    </label>
																			</div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default btn-sm">Type : <?php echo $rows['type'];?></button>
                                        <input type="hidden" name="type[<?php echo $id;?>]" value="<?php echo $rows['type'];?>" />
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm " name="required[<?php echo $id;?>]" id="required" value="{{ $rows['required'] }}" placeholder="Ex : required|email" />
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-primary btn-icon editForm" role="button" onclick="SximoModal('{{ URL::to('builder/editform/'.$row->id.'?field='.$rows['field'].'&alias='.$rows['alias']) }}','Edit Field : <?php echo $rows['field'];?>')">
                                            <i class="mdi mdi-format-list-bulleted-type"></i></a>
                                        <input type="hidden" name="label[<?php echo $id;?>]" value="<?php echo $rows['label'];?>" />
                                        <input type="hidden" name="alias[<?php echo $id;?>]" value="<?php echo $rows['alias'];?>" />
                                        <input type="hidden" name="field[<?php echo $id;?>]" value="<?php echo $rows['field'];?>" />
                                        <input type="hidden" name="form_group[<?php echo $id;?>]" value="<?php echo $rows['form_group'];?>" />
                                        <input type="hidden" name="sortlist[<?php echo $id;?>]" class="reorder" value="<?php echo $rows['sortlist'];?>" />
                                        <input type="hidden" name="opt_type[<?php echo $id;?>]" value="<?php echo $rows['option']['opt_type'];?>" />
                                        <input type="hidden" name="lookup_query[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_query'];?>" />
                                        <input type="hidden" name="lookup_table[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_table'];?>" />
                                        <input type="hidden" name="lookup_key[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_key'];?>" />
                                        <input type="hidden" name="lookup_value[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_value'];?>" />
                                        <input type="hidden" name="is_dependency[<?php echo $id;?>]" value="<?php echo $rows['option']['is_dependency'];?>" />
                                        <input type="hidden" name="lookup_dependency_key[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_dependency_key'];?>" />
                                        <input type="hidden" name="path[<?php echo $id;?>]" value="<?php echo $rows['option']['path'];?>" />
                                        <input type="hidden" name="upload_type[<?php echo $id;?>]" value="<?php echo $rows['option']['upload_type'];?>" />
                                        <input type="hidden" name="resize_width[<?php echo $id;?>]" value="<?php if(isset($rows['option']['resize_width'])) echo $rows['option']['resize_width'];?>" />
                                        <input type="hidden" name="resize_height[<?php echo $id;?>]" value="<?php if(isset($rows['option']['resize_height'])) echo $rows['option']['resize_height'];?>" />
                                        <input type="hidden" name="extend_class[<?php echo $id;?>]" value="<?php if(isset($rows['option']['resize_height'])) echo $rows['option']['resize_height'];?>" />
                                        <input type="hidden" name="tooltip[<?php echo $id;?>]" value="<?php if(isset($rows['option']['tooltip'])) echo $rows['option']['tooltip'];?>" />
                                        <input type="hidden" name="attribute[<?php echo $id;?>]" value="<?php if(isset($rows['option']['attribute'])) echo $rows['option']['attribute'];?>" />
                                        <input type="hidden" name="extend_class[<?php echo $id;?>]" value="<?php if(isset($rows['option']['extend_class'])) echo $rows['option']['extend_class'];?>" />
                                        <input type="hidden" name="select_multiple[<?php echo $id;?>]" value="<?php if(isset($rows['option']['select_multiple'])) echo $rows['option']['select_multiple'];?>" />
                                        <input type="hidden" name="image_multiple[<?php echo $id;?>]" value="<?php if(isset($rows['option']['image_multiple'])) echo $rows['option']['image_multiple'];?>" />

                                    </td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="infobox infobox-danger fade in">
                            <button type="button" class="close" data-dismiss="alert"> x </button>
                            <p> <strong>Note !</strong> Your primary key must be <strong>show</strong> and in <strong>hidden</strong> type </p>
                        </div>

                        <button type="submit" class="btn btn-xs btn-primary"> Save Changes </button>
                        <input type="hidden" name="id" value="{{ $row->id }}" />
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('style')
<link rel="stylesheet" href="{{ asset('modules/crud/vendor/parsley/parsley.css') }}">
<style type="text/css">
    .popover-content {
        display: block;
        padding: 10px;
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
        $('.expand-row').hide();
        $('[data-toggle="popover"]').popover();
        $('.btn-sm').click(function() {
            var id = $(this).attr('rel');
            $('.expand-row').hide();
            $(id).slideDown(100);

        });
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
        var formForm = $('#crudform'); 
        formForm.parsley();
        formForm.submit(function(){         
          if(formForm.parsley().isValid()){      
            var options = { 
              dataType: 'json', 
              beforeSubmit : function() {

              },
              success: function( data ) {
				if(data.status == 'success')
				{
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