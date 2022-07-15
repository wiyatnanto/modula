<div class="sximo_tools">
	<div class="row">
		<div class="col-md-6">
			
			<a href="javascript:void(0)" class="btn btn-success btn-sm actionButton" data-after-task="insert">
				<i class="fa fa-plus"></i> Save & New 
			</a>
			<a href="javascript:void(0)" class="btn btn-primary btn-sm actionButton" data-after-task="update">
				<i class="fa fa-pencil"></i> Save & Edit 
			</a>
			<a href="javascript:void(0)" class="btn btn-info btn-sm actionButton" data-after-task="return">
				<i class="fa fa-save"></i> Save & Return 
			</a>
		</div>

		<div class="col-md-6 text-right">
			<a href="javascript:void(0)" class="btn btn-danger btn-sm actionButton" onclick="ajaxClose('#{{ $actionId}}')" >
				<i class="fa fa-close"></i> Close 
			</a>
		</div>
	</div>
<hr />


</div>
</div>	

	{!! Form::open(array('url'=> $url, 'class'=>'form-horizontal','files' => true , 'id' =>$actionId.'-action' , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@foreach($layout as $info => $groups  )
		<fieldset>
			<legend> {{ $info }}</legend>

			@foreach($forms as $key=>$val)

				<?php $temp =  explode(',',$groups);?>
				@if(in_array($key , $temp))
					
					<div class="form-group row " >
						<label for="Name" class=" control-label col-md-4 "> {{ $val['title'] }} </label>
						<div class="col-md-8">
							@if(array_key_exists($key, $forms))
								{!! $val[ 'form'] !!}
							@endif
						</div> 
					</div>
					
				@endif					

			@endforeach
			
		</fieldset>
	@endforeach
	@include('CrudEngine.datatable.subform')
	<input type="hidden" name="{{ $this_key }}" value="{{ $key_value }}" />
	<input type="hidden" name="task" value="{{ $task_value }}" />
	<input type="hidden" name="data-after-task" id="data-after-task" value="" />

{!! Form::close() !!}
@include('CrudEngine.datatable.javascript')