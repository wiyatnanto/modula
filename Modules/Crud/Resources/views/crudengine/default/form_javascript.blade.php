<script type="text/javascript">


	$(function(){

		$('.CrudEngineDate').datepicker({format:'yyyy-mm-dd',autoClose:true})
		$('.CrudEngineDateTime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss',autoClose:true}); 
		$('.CrudEngineTime').timepicker()
		$('.CrudEngineYear').datepicker({minViewMode: 2,format: 'yyyy'});
		$('.CrudEngineEditor').summernote({ height: 150});


		$('#{{ $actionId}}-form .actionButton').click(function () {
			var task = $(this).attr('data-after-task');
			$('#data-after-task').val(task);
			$('#{{ $actionId}}-action').submit();
		})

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url( $url."?task=remove_file&file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});	



		var form = $('#{{ $actionId}}-action'); 
        form.parsley();

        form.submit(function()
        {         
          if (form.parsley().isValid())
          {      
            var options = { 
              dataType:      'json', 
              beforeSubmit : function() {
                $('.ajaxLoading').show(); 
              },
              success: function( data ) {
		          if(data.status == 'success')
		          {
		            notyMessage(data.message);
		            if(data.after =='update')
		            {
		            	$('input[name={{ $this_key}}]').val(data.id);	
		            } 
		            else if(data.after =='insert') {
		            	form.trigger('reset');
		            }
		            else {
		            	CrudEngineReload( '{{ $url }}','#{{ $actionId }}')
		            }
		            $('.ajaxLoading').hide();
		          } else {
		            notyMessageError(data.message);
		            $('.ajaxLoading').hide();
		          }
              }  
            }  
            $(this).ajaxSubmit(options); 
            return false;                 
		} 
		else {
			notyMessageError('Error ajax wile submiting !');
			return false;
		}      
    	});
	})

	function appendFormFiles(id){

	   $("."+id+"Upl").append('<input type="file" name="'+id+'[]" />')
	}	
</script>