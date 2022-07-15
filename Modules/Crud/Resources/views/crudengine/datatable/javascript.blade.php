<script type="text/javascript">


	$(function(){
		$('.addC').relCopy({})
		$('.CrudEngineDate').datepicker({format:'yyyy-mm-dd',autoClose:true})
		$('.CrudEngineDateTime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss',autoClose:true}); 
		$('.CrudEngineTime').timepicker()
		$('.CrudEngineYear').datepicker({minViewMode: 2,format: 'yyyy'});
		$('.CrudEngineEditor').summernote({ height: 150});


		$('#{{ $actionId}}View .actionButton').click(function () {
			var task = $(this).attr('data-after-task');
			$('#data-after-task').val(task);
			$('#{{ $actionId}}-action').submit();
		})

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
		          	var table = $('#{{ $actionId}}Table').DataTable();
					table.ajax.reload();

		            notyMessage(data.message);
		            if(data.after =='update')
		            {
		            	$('input[name={{ $this_key}}]').val(data.id);	
		            } 
		            if(data.after =='insert') {
		            	form.trigger('reset');
		            }
		            if(data.after =='return') {
		            	CrudEngine_Close('#{{ $actionId}}')
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
<style type="text/css">
	/* Uploaded CSS */
.thumb-image { float: left; padding: 5px; border: solid 1px #e9e9e9; margin:5px 10px 5px 0; }
.thumb-image .remove-uploaded-file { 
    background: #333 none repeat scroll 0 0;
    border-radius: 50%;
    color: #fff;
    font-weight: 600;
    margin-left: 80px;
    padding: 3px 8px 5px;
    position: absolute;
}
ul.uploadedLists li {
    border: 1px solid #eee;
    display: inline-block;
    float: left;
    height: 100px;
    margin: 5px 10px 5px 0;
    padding: 5px;
    width: 120px;
}
</style>