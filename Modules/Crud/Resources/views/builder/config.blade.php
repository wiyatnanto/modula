@extends('theme::backend.layouts.master')

@section('content')
<div class="tab-content">
    <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('crud::builder.tab',array('active'=>'config','type'=> $type))
                        <div class="row p-2 pt-3">
	                        <div class="col-md-6">
	                            {!! Form::open(array('url'=>'crud/builder/saveconfig/'.$name, 'class'=>'form-horizontal ','id'=>'crudinfo' , 'parsley-validate'=>'','novalidate'=>' ')) !!}
	                            <input type='hidden' name='id' id='id' value='{{ $row->id }}' />
	                            <div class="form-column mt-3">
	                                <h4 class="title mb-3"> Module Info </h4>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4">Name / Title </label>
	                                    <div class="col-md-8">
	                                        <div class="input-group mb-3">
											  <input type='text' name='title' id='title' class="form-control " required="true" value='{{ $row->title }}' />
											  <span class="input-group-text" id="basic-addon1">EN</span>
											</div>
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class="form-label col-md-4">Module Note</label>
	                                    <div class="col-md-8">
	                                    	<div class="input-group mb-3">
											  <input type='text' name='note' id='note' value='{{ $row->note }}' class="form-control input-sm" />
											  <span class="input-group-text" id="basic-addon1">EN</span>
											</div>
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4">Class Controller </label>
	                                    <div class="col-md-8">
	                                        <input type='text' name='name' id='name' readonly="1" class="form-control input-sm" required value='{{ $row->name }}' />
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4">Table Master</label>
	                                    <div class="col-md-8">
	                                        <input type='text' name='db' id='db' readonly="1" class="form-control input-sm" required value='{{ $row->db}}' />

	                                    </div>
	                                </div>
	                                <div class="mb-3" style="display:none;">
	                                    <label for="ipt" class=" form-label col-md-4">Author </label>
	                                    <div class="col-md-8">
	                                        <input type='text' name='author' id='author' class="form-control input-sm" readonly="1" value='{{ $row->author }}' />
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"></label>
	                                    <div class="col-md-8">
	                                        <button type="submit" name="submit" class="btn btn-xs btn-primary btn-icon-text">Update Module <i class="btn-icon-append" data-feather="save"></i></button>
	                                    </div>
	                                </div>
	                            </div>
	                            {!! Form::close() !!}
	                        </div>
	                        <div class="col-sm-6 col-md-6">
	                            @if($type !='report' && $type !='generic')
	                            {!! Form::open(array('url'=>'crud/builder/savesetting/'.$name, 'class'=>'form-horizontal ' ,'id'=>'crudsetting')) !!}
	                            <input type='text' name='id' id='id' value='{{ $row->id }}' style="display:none; " />
	                            <div class="form-column mt-3">
	                                <h4 class="title mb-3"> Module Setting </h4>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"> Grid Table Type </label>
	                                    <div class="col-md-8">
	                                        <select class="select2-select form-select" data-width="100%" name="type">
	                                            <option value="datatable" @if($row->type =='' or $row->type=='datatable') selected @endif > DataTable Complete </option>
	                                            <option value="default" @if($row->type =='default') selected @endif > jQuery Ajax Complete </option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"> Default Order </label>
	                                    <div class="col-md-8">
	                                        <select class="select2-select form-select" data-width="100%" name="orderby">
	                                            @foreach($tables as $t)
	                                            <option value="{{ $t['field'] }}" @if($setting['orderby']==$t['field']) selected="selected" @endif>{{ $t['label'] }}</option>
	                                            @endforeach
	                                        </select>
	                                    </div>
	                                    <div class="col-md-8 mt-2">
	                                        <select class="select2-select form-select" data-width="100%" name="ordertype">
	                                            <option value="asc" @if($setting['ordertype']=='asc' ) selected="selected" @endif> Ascending </option>
	                                            <option value="desc" @if($setting['ordertype']=='desc' ) selected="selected" @endif> Descending </option>
	                                        </select>

	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"> Display Rows </label>
	                                    <div class="col-md-8">
	                                        <select class="select2-select form-select" data-width="100%" name="perpage">
	                                            <?php $pages = array('10','20','30','50');
												foreach($pages as $page) {
												?>
	                                            <option value="<?php echo $page;?>" @if($setting['perpage']==$page) selected="selected" @endif> <?php echo $page;?> </option>
	                                            <?php } ?>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"> Form Method </label>
	                                    <div class="col-md-8">
	                                        <div class="form-check mb-2">
											                      <input type="radio" class="form-check-input" value="native" name="form-method" class="minimal-green" @if($setting['form-method']=='native' ) checked="checked" @endif >
																						<label class="form-check-label" for="native">
																							New Page
																						</label>
																					</div>
																					<div class="form-check mb-2">
											                      <input type="radio" class="form-check-input" value="modal" name="form-method" class="minimal-green" @if($setting['form-method']=='modal' ) checked="checked" @endif >
																						<label class="form-check-label" for="modal">
																							Modal
																						</label>
																					</div>
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"> View Method </label>
	                                    <div class="col-md-8">
	                                    		<div class="form-check mb-2">
											                      <input type="radio" class="form-check-input" value="native" name="view-method" class="minimal-green" @if($setting['view-method']=='native' ) checked="checked" @endif >
																						<label class="form-check-label" for="native">
																							New Page
																						</label>
																					</div>
																					<div class="form-check mb-2">
											                      <input type="radio" class="form-check-input" value="modal" name="view-method" class="minimal-green" @if($setting['view-method']=='modal' ) checked="checked" @endif >
																						<label class="form-check-label" for="modal">
																							Modal
																						</label>
																					</div>
	                                        <label class="radio-inline" style="display: none;">
	                                            <input type="radio" value="expand" name="view-method" class="minimal-green" @if($setting['view-method']=='expand' ) checked="checked" @endif /> Expand Grid
	                                        </label>
	                                    </div>
	                                </div>
	                                <div class="mb-3">
	                                    <label for="ipt" class=" form-label col-md-4"></label>
	                                    <div class="col-md-8">
	                                        <button type="submit" name="submit" class="btn btn-xs btn-primary btn-icon-text"> Update Setting <i class="btn-icon-append" data-feather="save"></i></button>
	                                    </div>
	                                </div>
	                            </div>
	                            {!! Form::close() !!}
	                            @endif
	                        </div>
	                        <div class="clr" style="clear:both;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
		var formInfo = $('#crudinfo'); 
        formInfo.parsley();
        formInfo.submit(function(){         
          if(formInfo.parsley().isValid()){      
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

		var formSetting = $('#crudsetting'); 
        formSetting.parsley();
        formSetting.submit(function(){         
          if(formSetting.parsley().isValid()){      
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