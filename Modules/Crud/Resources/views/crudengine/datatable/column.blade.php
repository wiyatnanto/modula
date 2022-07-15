<div class="sximo_tools">
	<div class="row">
		<div class="col-md-6"></div>
		<div class="col-md-6 text-right">			
			<a href="javascript:void(0)" class="btn btn-primary btn-sm actionButton" data-after-task="insert">
				 Save & New 
			</a>
			<a href="javascript:void(0)" class="btn btn-success btn-sm actionButton" data-after-task="update">
				 Save & Edit 
			</a>
			<a href="javascript:void(0)" class="btn btn-info btn-sm actionButton" data-after-task="return">
				 Save & Return 
			</a>

			<a href="javascript:void(0)" class="btn btn-danger btn-sm actionButton" onclick="CrudEngine_Close('#{{ $actionId}}')" >
				 Close 
			</a>
		</div>
	</div>
</div>	
@if($validation <= 0 )
	<p class="alert alert-danger"><i class="fa fa-warning"></i> <b>Warning !</b> this form does not any validation ! . Please set at least one validation input </p> 
@endif

	{!! Form::open(array('url'=> $url, 'class'=>'form-horizontal CrudEngineForm','files' => true , 'id' =>$actionId.'-action' , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	<div class="row"> 
	<?php $count = 12 / count($layout);?>
	@foreach($layout as $info => $groups  )
	
		<div class="col-md-{{ $count}}">
			<fieldset>
			<legend> {{ $info }}</legend>

			@foreach($forms as $key=>$val)
				
				<?php $temp =  explode(',', $groups);?>
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
			
		</div>
	@endforeach
	</div>

	@include('CrudEngine.datatable.subform')

	<input type="hidden" name="{{ $this_key }}" value="{{ $key_value }}" />
	<input type="hidden" name="task" value="{{ $task_value }}" />
	<input type="hidden" name="data-after-task" id="data-after-task" value="" />

{!! Form::close() !!}
@include('CrudEngine.datatable.javascript')