<?php
/*
Plugin Name: Ace Slider
Plugin URI: www.acetz.com
Description: This is an easy Slider plugin.
Author: Sudhanshu
Author URI: www.acetz.com
Version: 1.0.0
*/
function ace_installSlider()
{
	mysql_query("CREATE TABLE tbl_aceslider(id INT(55) UNSIGNED AUTO_INCREMENT PRIMARY KEY,image_id INT(55),title VARCHAR(255) NOT NULL,image VARCHAR(255) NOT NULL,reg_date TIMESTAMP)");
	$path = __DIR__ . '/gallery_images';
	if (!is_dir($path)) 
{
				mkdir($path, 0755, true);
	}
}
function ace_deactivateSlider()
{
	mysql_query("drop table tbl_aceslider");
}
function ace_pageSlider()
{
	add_menu_page('AceSlider_Page','Add Slider','manage_options','AceSlider_1','ace_clayout');
	add_submenu_page('AceSlider_1','SliderList_page','Slider List','manage_options','AceSlider_2','ace_clayout_2');
}
function ace_clayout()
{ ?>
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/css/custom.css">
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/font-awesome/css/font-awesome.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
	$(document).ready(function(){
	$("#form_content").submit(function(){
		var title_val=$("#title_val").val();
	if(title_val!="")
	{
		$("#acecontent_alert").show();
		$("#acecontent_btn").attr('disabled','disabled');
	$.ajax({
	dataType: "json",
	url: "<?php bloginfo('url');?>/wp-content/plugins/ace_slider/process_gallery.php",   	
	type: "POST",      				
	data:  new FormData(this), 		
	contentType: false,       		
	cache: false,					
	processData:false,  			
	success: function(data)  		
	{
		if($.trim(data.message)=='inserted')
		{
			$("#acecontent_btn").removeAttr('disabled');
			$('#form_content')[0].reset();
			$("#acecontent_alert").removeClass('alert-danger').addClass('alert-success').show();
			$("#acecontent_alert .msg").html("Data has been added successfully.");
			$("#acecontent_alert").fadeOut(8000);
		}
		if($.trim(data.message)=='updated')
		{
			$("#acecontent_btn").removeAttr('disabled');
			//$('#form_content')[0].reset();
			$("#acecontent_alert").removeClass('alert-danger').addClass('alert-success').show();
			$("#acecontent_alert .msg").html("Data has been updated successfully.");
			$("#acecontent_alert").fadeOut(8000);
			location.assign("admin.php?page=AceSlider_2");
		}
		else if($.trim(data.message)=='false')
		{
			$("#acecontent_btn").removeAttr('disabled');
			$("#acecontent_alert").removeClass('alert-success').addClass('alert-danger').show();
			$("#acecontent_alert .msg").html("Error, please try again and fill the form carefully.");
			$("#acecontent_alert").fadeOut(8000);
		}	
	}
});
	}
	else
	{
			$("#acecontent_btn").removeAttr('disabled');
			$("#acecontent_alert").removeClass('alert-success').addClass('alert-danger').show();
			$("#acecontent_alert .msg").html("Please fill all (*)mandatory fields.");
			$("#acecontent_alert").fadeOut(8000);
	}
	return false;
});
});
</script>
<div class="content">
<h1>Add Slider</h1>
<div class="head">
</div>
<?php
include('../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db=mysql_select_db(DB_NAME,$con);
$id=$_POST['id'];
$select_data=mysql_query("select * from tbl_aceslider where id='".$id."'");
$res_data=mysql_fetch_array($select_data);
?>
<form id="form_content" method="post" enctype="multipart/form-data">
	<div class="row">
	<span >Title</span>
	<input type="text" class="form-control" placeholder="Tilte" name="title" id="title_val" value="<?php echo $res_data['title']; ?>"  autofocus> 
    <?php
	if($id!="")
	{ ?>
		<input type="hidden" name="action" value="edit"  autofocus>
        <input type="hidden" name="rowid" value="<?php echo $id; ?>"  autofocus> 	
	<?php }
	else
	{ ?>
		<input type="hidden" name="action" value="add"  autofocus>
	<?php } ?>  	 	
	</div>
    <div class="row">
	<span >Upload File</span>
	<input type="file" class="form-control"  name="filename" id="file_val" <?php if($id!=""){ }else{ ?> required="required" <?php } ?> autofocus> 	
	</div>
<button  type="submit" id="acecontent_btn" class="btn btn-primary"><i class="fa fa-plus-square"></i>
<?php
	if($id!="")
	{ ?>
		Update 	
	<?php }
	else
	{ ?>
		Add
	<?php } ?> 
</button> 
</form>
<div class="alert alert-success" id="acecontent_alert"><span class="msg">Processing...</span></div>
</div>
<?php } 
function ace_clayout_2()
{ 
include('../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db=mysql_select_db(DB_NAME,$con);
?>
<link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/css/custom.css">
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/font-awesome/css/font-awesome.css">
	<script type="text/javascript" src="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/js/drag1.js"></script>
    <script type="text/javascript" src="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/js/drag2.js"></script>
    <script type="text/javascript">
$(document).ready(function(){ 
	$(function() {
		$("ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
			$.post("<?php bloginfo('url');?>/wp-content/plugins/ace_slider/adminC_updateDB.php", order, function(theResponse){
			location.reload();
			});
		}
		});
	}); 
});
function ace_delete(args)
{
	if(confirm('Do you want to delete this item')==true)
	{
		var action='deleted';
		$.post('<?php bloginfo('url');?>/wp-content/plugins/ace_slider/process_gallery.php',{action:action,rowid:args},function(data){
			if($.trim(data)=='deleted')
			{
				$("#recordsArrays_"+args).fadeOut(900);
			}
			});
	}
}
</script>
<div class="content">
		<div class="head">
			<div class="btn-group">
			<div class="clearfix"></div> 					
			<div class="clearfix"></div>
			</div>
		</div>
        <div class="content">
<?php
$sn=1;
$sel_Product=mysql_query("select * from tbl_aceslider order by image_id");
$count=mysql_num_rows($sel_Product);
?>
<h2><i class="fa fa-caret-down"></i>Image's List (<?php echo $count; ?>)</h2>
<!--product list-->
<ul class="product-list">
<?php
while($res_Product=mysql_fetch_array($sel_Product))
{ ?>
		<li id="recordsArrays_<?php echo $res_Product['id']; ?>">
			<img src="<?php bloginfo('url');?>/wp-content/plugins/ace_slider/gallery_images/<?php echo $res_Product['image']; ?>" alt="loading..">
			<div class="pull-left">
			<span><?php echo $res_Product['title']; ?></span>
			<div class="btn-group btn-group-xs">
			<div class="clearfix"></div>
            <span>
            		<form method="post" action="admin.php?page=AceSlider_1">
                    <input type="hidden" value="<?php echo $res_Product['id'];  ?>" name="id" />
                    <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i>Edit</button></form>
                    </span>
                    <span>
					<!--<a href="admin.php?page=AceSlider_1" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>--> 
					<a class="btn btn-danger" onclick="ace_delete('<?php echo $res_Product['id']; ?>')"><i class="fa fa-times"></i>  Delete</a> 
                    </span>
					<div class="clearfix"></div>
			</div>
			</div>
		</li>
 <?php $sn++;} ?>       
</ul>
</div>
</div>
<?php }
register_activation_hook(__FILE__,'ace_installSlider');
register_deactivation_hook(__FILE__,'ace_deactivateSlider');
add_action('admin_menu','ace_pageSlider');
?>