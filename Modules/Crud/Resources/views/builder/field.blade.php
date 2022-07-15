<script type="text/javascript" src="{{ asset('sximo5/js/simpleclone.js') }}" ></script>

<script>
responOptData('<?php echo $f['option']['opt_type'];?>');
responeFormType('<?php echo $f['type'];?>')	;	
$(document).ready(function(){
	$.fn.modal.Constructor.prototype.enforceFocus = function() {};

	 <?php 
	 if(preg_match('/(select|radio|checkbox)/',$f['type'])) 
	 {
		 if($f['option']['opt_type'] == 'external')  { 
			echo "\$('.datalist').hide(); \$('.database').show()";	 
		 } else { 
			echo "\$('.database').hide(); \$('.datalist').show()";
		} 
		 
	} else {
		echo "\$('.database').hide(); \$('.datalist').hide()";
	}?>	
			
	$("#lookup_table").jCombo("{{ url('builder/combotable') }}" , {
		selected_value : "<?php echo $f['option']['lookup_table'];?>" ,
		initial_text : ' Select Table',
		
	});

	$("#lookup_key").jCombo("{{ url('builder/combotablefield') }}?table=",
	{ selected_value : "<?php echo $f['option']['lookup_key'];?>", parent: "#lookup_table", initial_text : ' Primary Key' });

	<?php $lv = explode("-", $f['option']['lookup_value']); ?>

	
	
		$("#lookup_value1").jCombo("{{ url('builder/combotablefield') }}?table=",
		{ selected_value : "<?php echo (isset($lv[0]) ? $lv[0] : '');?>", parent: "#lookup_table",   initial_text : ' Display Text'}); 
		
		$("#lookup_value2").jCombo("{{ url('builder/combotablefield') }}?table=",
		{ selected_value : "<?php echo (isset($lv[1]) ? $lv[1] : '');?>", parent: "#lookup_table",   initial_text : ' Display Text'}); 
		
		$("#lookup_value3").jCombo("{{ url('builder/combotablefield') }}?table=",
		{ selected_value : "<?php echo (isset($lv[2]) ? $lv[2] : '');?>", parent: "#lookup_table",   initial_text : ' Display Text'}); 		
	
	$('a.addC').relCopy({});		

	
		
	});
	

	function responOptData( val) {
		//alert(val);
		if(val =='external') {
			$('#custom-value').attr('disabled','disabled');
			$('.ext').removeAttr('disabled','disabled');
			$('.database').show();$('.datalist').hide();
			
		} else {
			$('#custom-value').removeAttr('disabled');
			$('.ext').attr('disabled','disabled');	
			$('.database').hide();$('.datalist').show();
		}	
	}		
	
	function responeFormType(val)
	{

		if(val =='select' || val =='radio' || val =='checkbox') {
			if(val == 'radio' || val =='checkbox')
			{
				$('.dbasevalue').hide()
			} else {
				$('.dbasevalue').show()
			}

			$('.dataOpt').removeAttr('disabled','disabled');
			$('.ext').removeAttr('disabled','disabled');	
			$('#custom-value').removeAttr('disabled','disabled');
			$('.standart-form').show(); $('.file-upl').hide();
			$('.database').hide();$('.datalist').show();$('.file-upl').hide();
		
		} else if( val == 'file') {
			$('.standart-form').hide(); 
			$('.file-upl').show();	
			
		} else {

			$('.ext').attr('disabled','disabled');	
			$('#custom-value').attr('disabled','disabled');
			$('.dataOpt').attr('disabled','disabled');
			$('.standart-form').hide(); 
			$('.database').hide();$('.datalist').hide();$('.file-upl').hide();
		}
	
	}	
</script>
 {!! Form::open(array('url'=>'builder/saveformfield/'.$module_name, 'class'=>'form-horizontal')) !!}
<input type="hidden" name="alias" value="<?php echo $f['alias'];?>" />
<input type="hidden" name="field" value="<?php echo $f['field'];?>" />	
<input type="hidden" name="label" value="<?php echo $f['label'];?>" />	
<input type="hidden" name="form_group" value="<?php echo $f['form_group'];?>" />	
<input type="hidden" name="sortlist" value="<?php echo $f['sortlist'];?>" />
<input type="hidden" name="view" value="<?php echo $f['view'];?>" />
<input type="hidden" name="search" value="<?php echo $f['search'];?>" />
<input type="hidden" name="required" value="<?php echo $f['required'];?>" />
<input type="hidden" name="limited" value="<?php echo (isset($f['limited']) ? $f['limited'] : '');?>" />
<div class="p-1">			
  <div class="mb-3">
    <label for="ipt" class=" form-label">Form Type </label>

		<select name="type" id="type" onchange="responeFormType(this.value)" class="form-control input-sm">
		<?php foreach($field_type_opt as $val=>$item) { ?>
			<option  value="<?php echo $val;?>"
			<?php if($val == $f['type']) echo 'selected="selected"';?>
			> <?php echo $item;?></option>
		<?php } ?> 
		</select>
	  
  </div>  
  
  <div class="mb-3 standart-form"  style="display:none;">
    <label for="ipt" class=" form-label">Data Type </label>
		<label class=" cstvalue" >
			<input type="radio" name="opt_type"  onclick="responOptData(this.value)"
			<?php if($f['option']['opt_type'] =='datalist') echo 'checked';?>
			 class="dataOpt" value="datalist"/> Custom Value  
		</label>	
		<label class=" dbasevalue">
			<input type="radio" name="opt_type" onclick="responOptData(this.value)"
			<?php if($f['option']['opt_type'] =='external') echo 'checked';?>
			   class="dataOpt"  value="external"/> Database
		</label>	
  </div>    

  <div class="mb-3 standart-form datalist"  style="display:none;">
    <label for="ipt" class=" form-label">Custom Value </label>
		<div class="row">
		<?php $opt = explode(",",$f['option']['lookup_query']); ?>
		<?php if(count($opt) <= 0) {?>
		<label class="clonedInput clone " >
			<div class="col-sm-4">
			  <input type="text" name="custom_field_val[]" class="form-control input-sm col-xs-5"  placeholder="Value"  />
			</div>  
			<div class="col-sm-4">
			 <input type="text" name="custom_field_display[]" class="form-control input-sm col-xs-5" placeholder="Display Name" />
			</div> 			
		</label>
		<?php } else { 
			for($i=0; $i<count($opt);$i++) { $row =  explode(":",$opt[$i]); ?>
			<div class="clonedInput clone" style="clear:both; margin-bottom:5px;" >
				<div class="col-sm-4">
				<input type="text" name="custom_field_val[]"  class="form-control input-sm col-xs-5" style="width:100px;" 
				placeholder="Value"  value="<?php if(isset($row[0])) echo $row[0];?>" />
				</div>
					<div class="col-sm-4">
				<input type="text" name="custom_field_display[]" class="form-control input-sm col-xs-5" style="width:100px;"
				placeholder="Display Name"  value="<?php if(isset($row[1])) echo $row[1];?>"/>
				</div>
				
				<a onclick="$(this).parent().fadeIn(function(){ $(this).remove() }); return false" href="#" class="remove btn btn-xs btn-danger">-</a>			
			</div>			
			<?php } ?>
		<?php } ?>
		<a href="javascript:void(0);" class="addC btn btn-xs btn-info" rel=".clone">+</a>	
		</div>
		
		
	 
  </div>    

  
  
  <div class="mb-3 standart-form database" style="display:none;">
    <label for="ipt" class=" form-label">DataBase Select</label>
		<label class="col-md-12">
			<label class="form-label"> Database Name : </label>
		<select name="lookup_table" id="lookup_table"  class="ext form-control input-sm" style="width:100%;">
			<option value=""> -- Select Table -- </option>
		<?php
			foreach($tables as $row) 
			{
				?> <option value="<?php echo $row;?>" <?php if($row == $f['option']['lookup_table']) 
					echo 'selected="selected"';?>><?php echo $row;?></option>';			 			
		<?php } ?>
		</select>	
		</label>
		<label class="col-md-12">
			<label class="form-label"> Primary Key / Relation Key  </label>
			<select name="lookup_key" id="lookup_key"  class="ext form-control input-sm" style="width:100%;"></select>
		</label>
		
			<div class="col-md-12">
				<label class="form-label"> Display #1 : </label>
				<select name="lookup_value[]"  class="ext form-control input-sm " id="lookup_value1"  
				style="  "></select> 
			</div>	

			<div class="col-md-12">
				<label class="form-label"> Display #2 : </label>
				<select name="lookup_value[]"  class="ext form-control input-sm" id="lookup_value2"  
				style="  "></select>

			</div>

			<div class="col-md-12">
				<label class="form-label"> Display #3 : </label>
				<select name="lookup_value[]"  class="ext form-control input-sm" id="lookup_value3"  
			style=" "></select> 
			</div>
			
		


		<label class="col-md-12" style="display: none;">
		<input type="checkbox" name="is_dependency" class="ext" value="1" <?php if($f['option']['is_dependency'] ==1) echo 'checked' ;?> /> Parent Filter  </label>
		<label class="col-md-12">				
		<input name="lookup_dependency_key" type="text" class="ext form-control input-sm" id="lookup_key" style=" border-bottom: solid 1px #ddd;"  
		value="<?php echo $f['option']['lookup_dependency_key'];?>"	placeholder='Lookup Filter Key' />
		</label>		
		<label class="col-md-12" >
		
			<input type="checkbox" name="select_multiple"  value="1" <?php if(isset($f['option']['select_multiple']) && $f['option']['select_multiple'] =='1') echo 'checked="checked"';?>  /> Allow Multiple
		</label>			
 
  </div>  

  <div class="mb-3 standart-form file-upl"  style="display:none;">
    <label for="ipt" class=" form-label"> Upload File </code></label>
		<input name="path" type="text" id="path_to_upload" class="form-control input-sm" value="<?php echo $f['option']['path'];?>"/>
		<div class=""> 
			<input type="radio" name="upload_type" value="file"
			<?php if($f['option']['upload_type'] =='file') echo 'checked="checked"';?>
			/>  
			File 
		</div>
		<div class=""> 
			<input type="radio" name="upload_type" value="image" 
			<?php if($f['option']['upload_type'] =='image') echo 'checked="checked"';?>
			 />  
			Image / Picture  
		</div>
		
		<div class="imgResize form-inline">
			 Resize Image to ? : 
			Width : 
			<input name="resize_width" type="text" id="resize_width" class="form-control input-sm" style=" width:55px"
			value="<?php if(isset($f['option']['resize_width'])) echo $f['option']['resize_width'];?>"
			 />
			Height : 
			<input name="resize_height" type="text" id="resize_height" class="form-control input-sm" style=" width:55px"
			value="<?php if(isset($f['option']['resize_height'])) echo $f['option']['resize_height'];?>" />
		</div>

		<div class="" >
			<input type="checkbox" name="image_multiple"  value="1" <?php if(isset($f['option']['image_multiple']) && $f['option']['image_multiple'] =='1') echo 'checked="checked"';?>  /> Allow Multiple
		</div>		
				
  </div>   
   

  <div class="mb-3" style="display:none;">
    <label for="ipt" class=" form-label">Input Format ( Masking ) </label>
		<select name="format" class="form-control input-sm">
			<?php $array = array(
				'text' 			=> 'None',
				'phone'			=> 'Int Phone ',
				'currency'	 	=> 'USD Currency',
				'percent'		=> 'Percent'
			);
			foreach($array as $val=>$item) {?>
				<option value="<?php echo $val;?>"><?php echo $item;?></option>
			<?php } ?>
		</select>	  
  </div>  
<div class="form-column">
	<p class="mb-3"><a href="javascript://ajax" onclick="$( '.addhtml' ).toggle()">  More Option   </a></p>
	<div class="addhtml" style="display: none">  
  <div class="mb-3" >
    <label for="ipt" class=" form-label">Tooltip </label>
		<input name="tooltip" type="text" id="tooltip" class="form-control input-sm" value="<?php echo $f['option']['tooltip'];?>"/>  
  </div>  
  <div class="mb-3" style="display:none;">
    <label for="ipt" class=" form-label">Additional Class </label>
		<input name="extend_class" type="text" id="extend_class" class="form-control input-sm" value="<?php echo $f['option']['extend_class'];?>"/>
  </div>   
  
  <div class="mb-3 " >
    <label for="ipt" class=" form-label"> Custom <b>Prefix & Sufix </b> </label>
		  <input name="prefix" type="text" id="prefix" class="form-control input-sm" style="width: 30% !important; float: left; margin-right: 5px; " placeholder="Prefix"
		  value="<?php if(isset($f['option']['prefix'])) echo $f['option']['prefix'];?>" />
		  <input name="sufix" type="text" id="sufix" class="form-control input-sm" style="width: 30% !important;  float: left; " placeholder="Suffix"
		  value="<?php if(isset($f['option']['sufix'])) echo $f['option']['sufix'];?>" />
  </div>  


	

  <div class="mb-3 " >
    <label for="ipt" class=" form-label">Html Attribute</label>
		<textarea name="attribute" id="attribute" class="form-control input-sm" placeholder="style='width:50%'"><?php echo $f['option']['attribute'];?></textarea>
  </div>   
  </div>
</fieldset>  
  <div class="mb-3">
    <label for="ipt" class=" form-label"></label>
		<button type="submit" class="btn btn-xs btn-primary"> Save Changes </button>
		<input type="hidden" name="module_id" value="<?php echo $module_id;?>" />
  </div> 
	</div>    
 {!! Form::close() !!}
<style type="text/css">
.checkbox { display: block;}
.radio input, .checkbox input { left: 5px; margin-top: 5px;}
</style>
