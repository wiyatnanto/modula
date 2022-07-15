
@if($type =='crud')
<?php
	
	$actions = array(
			'create'	=> ['icon'=>'fa fa-plus'],
			'view'		=> ['icon'=>'fa fa-eye'],
			'update'	=> ['icon'=>'fa fa-pencil'],
			'copy'		=> ['icon'=>'fa fa-copy'],
			'delete'	=> ['icon'=>'fa fa-trash-o'],
			'export'	=> ['icon'=>'fa fa-download'],
			'print'		=> ['icon'=>'fa fa-print'],
			);


	if(count($button))
	{
		$action = [] ;
		foreach( $button as $act){
			if(array_key_exists($act ,  $actions ))
				$action[$act] = $actions[ $act  ];
		}
		
		$actions = $action ;
	}
?>

<div class="sximo_tools">
	<div class="row">
		<div class="col-md-4">
		
			<input type="text" class="input-sm form-control" placeholder=".. Type and Enter for Search .."  name="onsearch" />
		</div>

		<div class="col-md-8 pull-right text-right">
			@foreach( $actions as $key=> $val)
				@if($key =='export' )
				<a href="{{ url( $url.'?task='.$key) }}" class="btn btn-default btn-sm" mode="native"><i class="{{ $val['icon'] }}"></i> </a>
				@elseif($key =='print')
				<a href="{{ url( $url.'?task='.$key) }}" class="btn btn-default btn-sm" target="_blank" ><i class="{{ $val['icon'] }}"></i> </a>
				@else
				<a href="javascript:void(0)" class="btn btn-default btn-sm Action_Row" code="{{ $key }}" mode="native"><i class="{{ $val['icon'] }}"></i> </a>
				@endif
			@endforeach
			<a href="javascript:void(0)" class="btn btn-default btn-sm Action_Row tips" code="refresh" title="Reload"><i class="fa fa-refresh" ></i> </a>	
		</div>		
	</div>
</div>
@endif