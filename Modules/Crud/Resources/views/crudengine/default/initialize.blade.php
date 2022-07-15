<div class="ajaxLoading"></div>
<div class="" id="{{ $actionId}}-form">
</div>
<div class="" id="{{ $actionId}}">
</div>
<script type="text/javascript">
	$(function(){

		$('.ajaxLoading').show();
		$.get('<?php echo url( $url );?>',function( data ){			
			$('#{{ $actionId}}').html( data );
			$('.ajaxLoading').hide();
		});
		
		
	})

</script>