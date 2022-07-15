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
{!! Form::open(array('url'=> $url, 'class'=>'form-horizontal','files' => true , 'id' =>'sClassForm' , 'parsley-validate'=>'','novalidate'=>' ')) !!}

<ul class="nav nav-tabs CrudTab">
@foreach($layout as $info => $groups  )
	<li class="nav-item">
		<a class="nav-link" href="#{{ str_replace(" ","-",$info) }}" data-toggle="tab" role="tab">{{ $info }}</a>
	</li>
@endforeach	
</ul>

<!-- Tab panes -->
<div class="tab-content">
@foreach($layout as $info => $groups  )
	<div class="tab-pane" id="{{ str_replace(" ","-",$info) }}" role="tabpanel">
	<div style="padding: 20px;"> 
	@foreach($forms as $key=>$val)
		<?php $temp =  explode(',',$groups);?>
		@if(in_array($key , $temp))
			<div class="form-group row " >
				<label for="Name" class=" control-label col-md-4 "> {{ $val['title'] }}</label>
				<div class="col-md-8">
					@if(array_key_exists($key, $forms))
						{!! $val[ 'form'] !!}
					@endif
				</div> 
			</div>
			
		@endif		
	@endforeach
	</div>
	</div>
@endforeach	
</div>
	@include('CrudEngine.datatable.subform')
	<input type="hidden" name="{{ $this_key }}" value="{{ $key_value }}" />
	<input type="hidden" name="task" value="{{ $task_value }}" />
	<input type="hidden" name="data-after-task" id="data-after-task" value="" />
{!! Form::close() !!}
<script type="text/javascript">
	$(function(){
		$('.CrudTab a:first').tab('show')
	})
</script>
@include('CrudEngine.datatable.javascript')