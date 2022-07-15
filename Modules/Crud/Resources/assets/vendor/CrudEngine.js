
(function($) {

	if (!$.fn.datepicker) {
		$.getScript(CrudEngineLibrary +"/bootstrap-datepicker/bootstrap-datepicker.min.js");
	}
	if (!$.fn.datetimepicker) {
		$.getScript(CrudEngineLibrary +"/bootstrap.datetimepicker/bootstrap-datetimepicker.min.js");
	}
	if (!$.fn.parsley) {
		$.getScript(CrudEngineLibrary +"/parsley.min.js");
	}
	if (!$.toast) {
		$.getScript(CrudEngineLibrary +"/toast/js/jquery.toast.js");
	}	
	if (!$.fn.ajaxForm) {
		$.getScript(CrudEngineLibrary +"/jquery.form.js");
	}	
	if(!$.fn.timepicker){
		$.getScript(CrudEngineLibrary +"/timepicker/jquery.timepicker.min.js");
	}
	if(!$.fn.summernote) {
		$.getScript(CrudEngineLibrary +"/summernote/dist/summernote.min.js");
	}
	if(!$.fn.relCopy) {
		$.getScript(CrudEngineLibrary +"/simpleclone.js");
	}

	
    $.fn.crudEngine = function( options ) {

    	var settings = $.extend({
            action      : 'action'	     
        }, options);


        return this.each( function() {

			$(settings.id +' ul.pagination li a').on("click",function(){
				var link = $(this).attr('href');
				CrudEngineReload( link , settings.id );
				
			});

			$(settings.id +' .ajaxCallback').click(function () {
				var task = $(this).attr('code');
				var url = $(this).attr(settings.action);

				if(task =='create')	{
					var href = settings.action +'?task='+ task ;
					$('.ajaxLoading').show();
					$.get(href,function( data ){	
						$(  settings.id  ).hide( );		
						$(  settings.id +'-form' ).show(  );
						$(  settings.id +'-form' ).html( data );
						$('.ajaxLoading').hide();
					});				
				} 
				else if(task =='view')	{
					var href = $(this).attr('href');
					$('.ajaxLoading').show();
					$.get(href,function( data ){	
						$(  settings.id  ).hide( );		
						$(  settings.id +'-form' ).show( );
						$(  settings.id +'-form' ).html( data );
						$('.ajaxLoading').hide();
					});	
					return false;			
				} 
				else if(task =='update')	{
					var href = $(this).attr('href');
					$('.ajaxLoading').show();
					$.get(href,function( data ){	
						$(  settings.id  ).hide( );		
						$(  settings.id +'-form' ).show(  );
						$(  settings.id +'-form' ).html( data );
						$('.ajaxLoading').hide();
					});		
					return false;
				}
				else if(task =='search')	{
					var href = settings.action +'?task=search';
					$('.ajaxLoading').show();
					$.get(href,function( data ){	
						$(  settings.id  ).hide( );		
						$(  settings.id +'-form' ).show( );
						$(  settings.id +'-form' ).html( data );
						$('.ajaxLoading').hide();
					});	
					return false;					
				} 									
				else if(task =='print')	{
					var href = $(this).attr('href');	
					return false;					
				} 
				else if(task =='download')	{
					var href = settings.action +'?task=download';	
					$.get(href,function( data ){

					});
					return false;
				}									
				else if( task =='copy') {
					var form = settings.id+ 'table'; 
					if(confirm('Areu sure copy selected row(s)'))
					{			
						$('#task').val('copy');
						var action = $(form).attr('action');
						var datas = $( form + ' :input').serialize();
						$('.ajaxLoading').show();
						$.post( action ,datas,function( data ) {
							if(data.status =='success')
							{
								notyMessage(data.message );
								CrudEngineReload( settings.action , settings.id );

							} else {
								notyMessage(data.message );
							}	
							$('.ajaxLoading').hide();			
						})
					}
				}	
				else if(task =='delete')	{
					var form = settings.id+ 'table'; 
					if(confirm('Areu sure delete selected row(s)'))
					{			
						$('#task').val('delete');
						var action = $(form).attr('action');
						var datas = $( form + ' :input').serialize();
						$('.ajaxLoading').show();
						$.post( action ,datas,function( data ) {
							if(data.status =='success')
							{
								notyMessage(data.message );
								CrudEngineReload( settings.action , settings.id );

							} else {
								notyMessage(data.message );
							}		
							$('.ajaxLoading').hide();		
						})
					}				
				} 
				else if( task =='close') {
					$( settings.id  ).show( );	
					$( settings.id +'-form' ).hide( data );
				}
				
			});
		})	
	}			


}(jQuery));

function CrudEngineModal( url , title)
{
	$('#CrudEngineModal').html(' ....Loading content , please wait ...');
	$('.modal-title').html(title);
	$('#CrudEngineModal-content').load(url,function(){
	});
	$('#CrudEngineModal').modal('show');	
}


function CrudEngineLoad( href , id )
{
	$.get(href,function( data ){	
		$( id  ).show( );		
		$( id +'-form' ).show(  );
		$( id +'-form' ).html( data );
	});
}

function CrudEngineReload( href , id )
{
	$('.ajaxLoading').show();
	$.get(href,function( data ){	
		$( id  ).html( data );	
		$( id  ).show();		
		$( id +'-form' ).hide(  );
		$( id +'-form' ).html( '' );
		$('.ajaxLoading').hide();
	});
}

function CrudEngine_Close( id )
{
	$( id +'-form' ).html('');	
	$( id +'-form' ).hide();
	$( id  ).show();	
}
function CrudEnginePrint(url )
{
	var w = 800 ;	
	var h =  600 ;	
	newwindow=window.open(url,'name','height='+w+',width='+h+',resizable=yes,toolbar=no,scrollbars=yes,location=no');
	if (window.focus) {newwindow.focus()}
}

function notyMessage(message)
{
	$.toast({
	    heading: 'Success',
	    text: message,
	    position: 'top-right',
	    icon: 'success',
	    hideAfter: 3000,
	    stack: 6
	});	
}
function notyMessageError(message)
{
	$.toast({
	    heading: 'Error',
	    text: message,
	    position: 'top-right',
	    icon: 'error',
	    hideAfter: 3000,
	    stack: 6
	});	
}

function sClassDelete(  id  )
{	
	if(confirm('Areu sure delete selected row(s)'))
	{
		$('#task').val('delete');
		var action = $(id).attr('action');
		var datas = $( id +'Table :input').serialize();
		alert(datas);
		$.post( action ,datas,function( data ) {
			if(data.status =='success')
			{
				notyMessage(data.message );
				//ajaxFilter( id ,url+'/data' );
			} else {
				notyMessage(data.message );
			}				
		});

	    return false; 
	}

}

function sClassCopy(  id  )
{	
	alert(id);
	if(confirm('Areu sure Copy selected row(s)'))
	{

		var form = $(id); 
		var options = { 
	      dataType:      'json', 
	      beforeSubmit : function() {
	        $('.ajaxLoading').show(); 
	      },
	      success: function( data ) {
	          if(data.status == 'success')
	          {
	            notyMessage(data.message);
	            $('.ajaxLoading').hide();$('#sximo-modal').modal('hide'); 
	          } else {
	            notyMessageError(data.message);
	            $('.ajaxLoading').hide();return false;
	          }
	      }  
	    } 

	    $(this).ajaxSubmit(options); 
	    return false; 
	}    
}

$(function(){
	$("ul.pagination li a").addClass("page-link")
})