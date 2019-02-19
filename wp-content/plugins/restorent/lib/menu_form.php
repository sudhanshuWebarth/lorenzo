<?php 
$Category_1=new callFiles();
$Category_2=new operations();
 ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="widget-box">
<div class="widget-header widget-header-flat">
<?php if(isset($_REQUEST['args'])){
	$action=2;
	$menu_value=explode("|",$_REQUEST['args']);
	$result_Menu=$Category_2->queryWhere("lrn_menu",array('menu_discription','menu_price','menu_category_id','menu_subcategory_id','menu_image','menu_recipe','menu_ingredients'),array("id"=>$menu_value[0]));
	$ingredients_Array=explode("|",$result_Menu[0]['menu_ingredients']);
	} ?>
<h4 class="widget-title smaller blue"><?php if($action==2){ ?>Update Menu<?php }else{?>Add New Menu<?php } ?>  </h4>
</div>
<div class="widget-body">
<div class="widget-main">
<form role="form" id="menu_form"  class="form-group form" enctype="multipart/form-data" >
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label>Menu Name</label> 
<input type="text" class="form-control" name="menu_name" placeholder="Menu Name" <?php if($action==2){ ?> value="<?php echo $menu_value[1]; ?>" <?php } ?> required="required">
</div></div> </div>
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label for="latitude">Discription:</label>
<textarea class="form-control" name="menu_discription" required="required"><?php if($action==2){ echo $result_Menu[0]['menu_discription'];} ?></textarea>
</div></div></div>
<div class="row">	
<div class="col-sm-2">
<div class="form-group">
<label for="Price">Price:</label>
<input type="text" class="form-control" name="menu_price" placeholder="Price" <?php if($action==2){ ?> value="<?php echo $result_Menu[0]['menu_price']; ?>" <?php } ?> required="required">
</div> </div>    
<div class="col-sm-4">
<div class="form-group">
<label for="category" >Category:</label>
<select name="menu_category" class="form-control">
<?php
if($Category_2->getCount("select id from lrn_category")>0)
{
	$category_List=$Category_2->queryWhereCustom("lrn_category",array('id','category_name')," order by id");
	foreach($category_List as $list)
	{ ?>
	<option <?php if($action==2){ if($result_Menu[0]['menu_category_id']==$list['id']){?> selected="selected" <?php }} ?> value="<?php echo $list['id'].'|'.$list['category_name']; ?>"><?php echo $list['category_name']; ?></option>
<?php }
} else{ ?>
	<option value="">Empty</option>
<?php } ?>
</select>
</div> </div>
<div class="col-sm-4">
<div class="form-group">
<label for="category" >Sub Category:</label>
<select name="menu_subcategory" class="form-control">
<?php
if($Category_2->getCount("select id from lrn_subcategory")>0)
{
	$subCategory_List=$Category_2->queryWhereCustom("lrn_subcategory",array('id','subcategory_name')," order by id");
	foreach($subCategory_List as $list)
	{ ?>
	<option <?php if($action==2){ if($result_Menu[0]['menu_subcategory_id']==$list['id']){?> selected="selected" <?php }}?> value="<?php echo $list['id'].'|'.$list['subcategory_name']; ?>"><?php echo $list['subcategory_name']; ?></option>
<?php }
} else{ ?>
	<option value="">Empty</option>
<?php } ?>
</select>
</div> </div>                           
<div class="col-sm-2">
<div class="form-group img-upload">
<label>Menu Image</label>
<input type="file" class="form-control" name="menu_image" <?php if($action==2){ }else{?> required="required" <?php }?> > 
</div></div></div>
<div class="row">
<div class="col-sm-10">
<div class="form-group">
<label for="menu_recipe">Menu Recipe:</label>
<textarea class="form-control" name="menu_recipe" id="menu_recipe" required="required"><?php if($action==2){ echo $result_Menu[0]['menu_recipe'];} ?></textarea>
</div></div>
<?php if($action==2){ ?> 
<div class="col-sm-2">
<div class="form-group">
<label for="Ingredients">Menu Image</label>
<?php echo $Category_1->image_Url(array('lorenzo','restorent','menu_image',$result_Menu[0]['menu_image']),array('100','100')); ?>
</div></div>
<?php } ?>
</div>
<div class="row">
<div class="col-sm-12">
<label for="Ingredients">Ingredients</label>
<div class="addItem">
<?php
if($action==2)
{
	$vs=1;$i=1;$j=1;$k=1;
	foreach($ingredients_Array as $ingredients)
	{ ?>
<div class="feature" id="<?php echo $vs; ?>">
<div class="col-sm-6"><div class="form-group"><label>Text </label><input class="form-control" type="text" value="<?php echo $ingredients;?>" name="menu_ingredients[]">
<button type="button" <?php if($k!=count($ingredients_Array)){ ?> style="display:none;" <?php } ?> class="btn btn-xs btn-primary  " id="add<?php echo $vs; ?>" onClick="addField(<?php echo $vs; ?>,<?php echo $vs; ?>)"><i class="fa fa-plus"></i></button>
<button type="button" <?php if($i!=0){ ?> onclick="subsField(<?php echo $vs; ?>)" <?php } ?> class="btn btn-xs btn-danger "><i class="fa fa-minus"></i></button>
</div></div></div>
<?php $k++; 
$vs=$i+$j;
$i=$vs;
$j=$vs;	}
}
else
{ ?>
<div class="feature" id="1">
<div class="col-sm-6"><div class="form-group"><label>Text </label><input class="form-control" type="text"  placeholder="1 Living Room" name="menu_ingredients[]">
<button type="button" class="btn btn-xs btn-primary  " id="add1" onClick="addField(1,1)"><i class="fa fa-plus"></i></button>
<button type="button" class="btn btn-xs btn-danger "><i class="fa fa-minus"></i></button>
</div></div></div>
<?php } ?>
</div></div></div>
<div class="col-sm-12 text-center"><br> 
<?php if($action==2)
{ ?>
	<input type="hidden" value="<?php echo $action; ?>" name="action" />
    <input type="hidden" value="<?php echo $menu_value[0]; ?>" name="menu_id" />
<?php }
else
{ ?>
	<input type="hidden" value="1" name="action" />
<?php }?>
<button type="submit" name="submit" id="acecontent_btn" class="btn btn-xs btn-primary"><?php if($action==2){?>Update Menu<?php }else{?>Add Menu<?php }?></button>
</div>
</form></div></div></div>
<script>
$(document).ready( function () {
 $("#menu_form").submit(function(){
	 for (var i in CKEDITOR.instances) {
        CKEDITOR.instances[i].updateElement();
		}
	 $("#acecontent_btn").attr('disabled','disabled');
	 $("body").prepend("<div class='alert alert-success' id='alert_category'>Processing....</div>");
$.ajax({
	dataType: "json",
	url: "<?php echo $Category_1->file_Url(array('lorenzo','restorent','process_menu')); ?>",  	
	type: "POST",      				
	data:  new FormData(this), 		
	contentType: false,       		
	cache: false,					
	processData:false,  			
	success: function(data)  		
	{
		if($.trim(data.status)==1)
		{
			$("#acecontent_btn").removeAttr('disabled');
			$('#menu_form')[0].reset();
			$("#alert_category").html(data.message);
			setTimeout(function(){ $(".alert.alert-success").remove(); },1000);	
			location.assign("?page=Menu_List");
		}
		else if($.trim(data.status)==0)
		{
			$("#acecontent_btn").removeAttr('disabled');
			$('#menu_form')[0].reset();
			$("#alert_category").removeClass("alert-success").addClass("alert-danger");
			$("#alert_category").html(data.message);
			setTimeout(function(){ $(".alert.alert-danger").remove(); },1000);
		}
	}
});
return false;
});
} );
function refresh_List()
{
	location.reload();	
}
</script>