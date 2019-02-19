<?php
/*
Plugin Name: Ace Social Media
Plugin URI: www.acetz.com
Description: This is an easy Social Media plugin.
Author: Sudhanshu
Author URI: www.acetz.com
Version: 1.0.0
*/
function ace_installSocial()
{
	mysql_query("CREATE TABLE tbl_acesocial(id INT(55) UNSIGNED AUTO_INCREMENT PRIMARY KEY,facebook VARCHAR(255) NOT NULL,twitter VARCHAR(255) NOT NULL,google_plus VARCHAR(255) NOT NULL,youtube VARCHAR(255) NOT NULL)");
}
function ace_deactivateSocial()
{
	mysql_query("drop table tbl_acesocial");
}
function ace_pageSocial()
{
	add_menu_page('AceSocial_Page','Add Social link','manage_options','AceSocial_1','aceSocial_clayout');
	//add_submenu_page('AceSocial_1','SliderList_page','Slider List','manage_options','AceSlider_2','ace_clayout_2');
}
function aceSocial_clayout()
{ ?>
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_social_media/css/custom.css">
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_social_media/font-awesome/css/font-awesome.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
	$(document).ready(function(){
	$("#form_content").submit(function(){
		$("#acecontent_alert").show();
		$("#acecontent_btn").attr('disabled','disabled');
	$.ajax({
	dataType: "json",
	url: "<?php bloginfo('url');?>/wp-content/plugins/ace_social_media/process_social.php",   	
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
			//$('#form_content')[0].reset();
			$("#acecontent_alert").removeClass('alert-danger').addClass('alert-success').show();
			$("#acecontent_alert .msg").html("Data has been added successfully.");
			$("#acecontent_alert").fadeOut(8000);
			location.reload();
		}
		if($.trim(data.message)=='updated')
		{
			$("#acecontent_btn").removeAttr('disabled');
			//$('#form_content')[0].reset();
			$("#acecontent_alert").removeClass('alert-danger').addClass('alert-success').show();
			$("#acecontent_alert .msg").html("Data has been updated successfully.");
			$("#acecontent_alert").fadeOut(8000);
			location.reload();
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
	return false;
});
});
</script>
<div class="content">
<h1>Add Social Link (Please insert urls with https:// )</h1>
<div class="head">
</div>
<?php
include('../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db=mysql_select_db(DB_NAME,$con);
$select_data=mysql_query("select * from tbl_acesocial");
$res_data=mysql_fetch_array($select_data);
$id=$res_data['id'];
?>
<form id="form_content" method="post" enctype="multipart/form-data">
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
	<div class="row">
	<span >Facebook</span>
	<input type="text" class="form-control" placeholder="facebook" name="facebook" id="facebook_val" value="<?php echo $res_data['facebook']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Twitter</span>
	<input type="text" class="form-control" placeholder="twitter" name="twitter" id="twitter_val" value="<?php echo $res_data['twitter']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Google Plus</span>
	<input type="text" class="form-control" placeholder="Google Plus" name="google_plus" id="google_plus_val" value="<?php echo $res_data['google_plus']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Youtube</span>
	<input type="text" class="form-control" placeholder="Youtube" name="youtube" id="youtube_val" value="<?php echo $res_data['youtube']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Instagram</span>
	<input type="text" class="form-control" placeholder="Instagram" name="instagram" id="instagram_val" value="<?php echo $res_data['instagram']; ?>"  autofocus>  	 	
	</div>
<button  type="submit" id="acecontent_btn" class="btn btn-primary"><i class="fa fa-plus-square"></i>
<?php
	if($id!="")
	{ ?>
		Update 	
	<?php }
	else
	{ ?>
		Save
	<?php } ?> 
</button> 
</form>
<div class="alert alert-success" id="acecontent_alert"><span class="msg">Processing...</span></div>
</div>
<?php } 
register_activation_hook(__FILE__,'ace_installSocial');
register_deactivation_hook(__FILE__,'ace_deactivateSocial');
add_action('admin_menu','ace_pageSocial');
?>