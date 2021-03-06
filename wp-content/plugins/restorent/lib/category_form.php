<?php 
$Category_1=new callFiles();
$Category_2=new operations();
 ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
<div class="widget-box">
<div class="widget-header widget-header-flat">
<?php if(isset($_REQUEST['args'])){
	$action=2;
	$category_value=explode("|",$_REQUEST['args']);
	} ?>
<h4 class="widget-title smaller blue"><?php if($action==2){ ?> Update Category  <?php }else{ ?> Add New Category <?php }?>  </h4>
</div>
<div class="widget-body">
<div class="widget-main">
<form role="form" id="category_form"  class="form-group form" enctype="multipart/form-data" method="post">
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label>Category Name</label> 
<input type="text" class="form-control" name="category_name" placeholder="Category Name" <?php if($action==2){ ?> value="<?php echo str_replace("and","&",$category_value[1]); ?>" <?php } ?> required>
</div></div> </div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Category Tag</label> 
<input type="text" class="form-control" name="category_tag" placeholder="Category Tag" <?php if($action==2){ ?> value="<?php echo str_replace("and","&",$category_value[2]); ?>" <?php } ?> required>
</div></div>
<div class="col-sm-6">
<div class="form-group">
<label>Category Image</label> 
<input type="file" class="form-control" name="category_image"  <?php if($action==2){ ?> <?php }else{?> required <?php } ?> >
</div></div>
 </div>
<div class="col-sm-12 text-center"><br> 
<?php if($action==2)
{ ?>
	<input type="hidden" value="<?php echo $action; ?>" name="action" />
    <input type="hidden" value="<?php echo $category_value[0]; ?>" name="category_id" />
<?php }
else
{ ?>
	<input type="hidden" value="1" name="action" />
<?php }?>
<button type="submit" name="submit" value="save" id="acecontent_btn" class="btn btn-xs btn-primary"><?php if($action==2){ ?> Update Category  <?php }else{ ?> Add Category <?php }?></button>
</div>
</form></div></div></div>
<a onclick="refresh_List()">Refresh List</a>
<div id="userBody">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-data table-blue display" id="datatable">
    <thead>
        <tr>
            <th>SNo.</th>
            <th>Category Image</th>
            <th>Category / Tag</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
	if($Category_2->getCount("select id from lrn_category")>0)
	{
	$category_List=$Category_2->queryWhereCustom("lrn_category",array('id','category_name','category_tag','category_image')," order by id desc");
	$sn=1;
	foreach($category_List as $list)
	{
	?>
        <tr id="ace_row<?php echo $list['id'];?>">
        	<td><?php echo $sn; ?></td>
            <td><?php echo $Category_1->image_Url(array('lorenzo','restorent','menu_image',$list['category_image']),array('60','60')); ?></td>
            <td><?php echo $list['category_name'].' / '.$list['category_tag']; ?></td>
            <td>
<div class="btn-group btn-group-xs" style="width:auto; margin-left:auto; margin-right:auto; display:table;">
<div class="clearfix"></div>
<button type="button" onclick="location.assign('?page=Add_Category&args=<?php echo $list['id'].'|'.str_replace("&","and",$list['category_name']).'|'.str_replace("&","and",$list['category_tag']); ?>')" class="btn btn-primary"><i class="fa fa-trash-o"></i> Edit</button>
<button type="button" onclick="deleteAce('<?php echo $Category_1->file_Url(array('lorenzo','restorent','process_delete')); ?>','lrn_category','<?php echo $list['id'];?>')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Del</button>
<div class="clearfix"></div>
</div>
</td>
</tr>  
        <?php $sn++; } }?>   
    </tbody>
</table>
</div>
<script>
$(document).ready( function () {
 $('#datatable').DataTable();
 $("#category_form").submit(function(){
	 $("#acecontent_btn").attr('disabled','disabled');
	 $("body").prepend("<div class='alert alert-success' id='alert_category'>Processing....</div>");
$.ajax({
	dataType: "json",
	url: "<?php echo $Category_1->file_Url(array('lorenzo','restorent','process_category')); ?>",  	
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
			$('#category_form')[0].reset();
			$("#alert_category").html(data.message);
			setTimeout(function(){ $(".alert.alert-success").remove(); },1000);	
			if(data.todo=="update")
			{
				location.assign("?page=Add_Category");
			}
		}
		else if($.trim(data.status)==0)
		{
			$("#acecontent_btn").removeAttr('disabled');
			$('#category_form')[0].reset();
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