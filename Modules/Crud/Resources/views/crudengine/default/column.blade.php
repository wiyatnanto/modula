<div class="sximo_tools">
	<div class="row">
		<div class="col-md-12 text-right">
			
			<a href="javascript:void(0)" class="btn btn-primary btn-sm actionButton" data-after-task="insert">
				<i class="fa fa-plus"></i> Save & New 
			</a>
			<a href="javascript:void(0)" class="btn btn-success btn-sm actionButton" data-after-task="update">
				<i class="fa fa-pencil"></i> Save & Edit 
			</a>
			<a href="javascript:void(0)" class="btn btn-info btn-sm actionButton" data-after-task="return">
				<i class="fa fa-save"></i> Save & Return 
			</a>
	
			<a href="javascript:void(0)" class="btn btn-danger btn-sm " onclick="CrudEngine_Close('#{{ $actionId}}')" >
				<i class="fa fa-close"></i> Close 
			</a>
		</div>
	</div>
<hr />


</div>
</div>	

	{!! Form::open(array('url'=> $url, 'class'=>'form-horizontal','files' => true , 'id' =>$actionId.'-action' , 'parsley-validate'=>'','novalidate'=>' ')) !!}
@if($validation <= 0 )
	<p class="alert alert-danger"><i class="fa fa-warning"></i> <b>Warning !</b> this form does not any validation ! . Please set at least one validation input </p> 
@endif	
	<div class="row"> 
	<?php $count = 12 / count($layout);?>
	@foreach($layout as $info => $groups  )
		<div class="col-md-{{ $count}}">
			<fieldset>
			<legend> {{ $info }}</legend>

			@foreach($forms as $key=>$val)

				<?php $temp =  explode(',',$groups);?>
				@if(in_array($key , $temp))

					@if($this_key == $key)


					@else					
					<div class="form-group row " >
						<label for="Name" class=" control-label col-md-4 "> {{ $val['title'] }} </label>
						<div class="col-md-8">
							@if(array_key_exists($key, $forms))
								{!! $val[ 'form'] !!}
							@endif
						</div> 
					</div>
					@endif
					
				@endif					

			@endforeach
			</fieldset>
			
		</div>
	@endforeach
	</div>

	<input type="hidden" name="{{ $this_key }}" value="{{ $key_value }}" />
	<input type="hidden" name="task" value="{{ $task_value }}" />
	<input type="hidden" name="data-after-task" id="data-after-task" value="" />

{!! Form::close() !!}
@include('CrudEngine.default.form_javascript')