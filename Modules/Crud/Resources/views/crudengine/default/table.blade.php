@include( 'CrudEngine.default.toolbar')
<div class="table-responsive" style="padding-bottom: 50px;">
 {!! Form::open(array('url'=> $url, 'class'=>'form-vertical','files' => true ,'id'=> $actionId .'table')) !!}
<table class="table table-hover table-striped table-bordered">
	<thead>
		<tr>
			@if($type =='crud') <th> <input type="checkbox" class="checkall" />	 </th> @endif
			<th width="100"> </th>
			@foreach($fields as $key=>$val)
				<th> {{ $val }}</th>
			@endforeach	
			
			
		</tr>
	</thead>

	<tbody>
		@foreach($rows as $row)
		<tr>
			@if($type =='crud')
				<td> <input type="checkbox" class="ids" name="ids[]" value="{{ $row[$this_table.'.'.$this_key] }}" /></td>
				@endif			
			

			<td> 
				<div class="dropdown">
				  <button class="btn btn-white btn-xs  dropdown-toggle" type="button" data-toggle="dropdown"> Action
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
				 	<li><a href="{{ url($url.'?task=view&id='.$row[$this_table.'.'.$this_key] )}}" code="view" class="dropdown-item ajaxCallback" title=""><i class="fa  fa-search "></i> View </a></li>
				 	<li>
				 		<a  href="{{ url($url.'?task=update&id='.$row[$this_table.'.'.$this_key]) }}" code="update"  class="dropdown-item ajaxCallback" title=""><i class="fa fa-pencil "></i> Edit</a>
				 	</li>
				  </ul>
				</div>
			</td>	
			@foreach($fields as $key=>$val)
				<td> {!!  $row[$key] !!}</td>
			@endforeach						
		</tr>
		@endforeach
		
	</tbody>
</table>
<input type="hidden" name="task" value="copy" id="task" />
{!! Form::close() !!}
</div>

<div class="Page navigation example">	
	{!! $paginator !!}
</div>	

<script type="text/javascript">
	$(document).ready(function(){

	 	$('#<?php echo $actionId ;?>').crudEngine({
	    	action  : '<?php echo url($url);?>',
	    	id 		:  '#{{ $actionId }}'
	    });

		$("#<?php echo $actionId ;?> ul.pagination li a").addClass("page-link")
		$("#<?php echo $actionId ;?> ul.pagination li a ").on("click",function(){
			var link = $(this).attr('href');
			return false;
		});
		/* if search is entered */
		$( '#<?php echo $actionId ;?> input[name=onsearch]').keyup(function( e ){
			if (e.keyCode === 13) {
		       CrudEngineReload( '{{ url($url."?search=")}}'+$(this).val() , '#{{ $actionId}}');
		    }
		})	
		$('#<?php echo $actionId ;?> .checkall').on('click',function() {
			var cblist = $(".ids");
			if($(this).is(":checked"))
			{				
				cblist.prop("checked", !cblist.is(":checked"));
			} else {	
				cblist.removeAttr("checked");
			}	
		});
	})
</script>

