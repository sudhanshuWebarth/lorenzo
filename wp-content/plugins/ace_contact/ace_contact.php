<?php
/*
Plugin Name: Ace Contact Info
Plugin URI: www.acetz.com
Description: This is an easy Contact Info plugin.
Author: Sudhanshu
Author URI: www.acetz.com
Version: 1.0.0
*/
function ace_installContact()
{
	mysql_query("CREATE TABLE tbl_acecontact(id INT(55) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(255) NOT NULL,phone VARCHAR(255) NOT NULL,email VARCHAR(255) NOT NULL,address VARCHAR(400) NOT NULL,tag_line VARCHAR(500) NOT NULL)");
}
function ace_deactivateContact()
{
		mysql_query("drop table tbl_acecontact");
}
function ace_pageContact()
{
	add_menu_page('AceContact_Page','Contact','manage_options','AceContact_1','aceContact_clayout');
	//add_submenu_page('AceSocial_1','SliderList_page','Slider List','manage_options','AceSlider_2','ace_clayout_2');
}
function aceContact_clayout()
{ ?>
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_contact/css/custom.css">
    <link rel="stylesheet" href="<?php bloginfo('url');?>/wp-content/plugins/ace_contact/font-awesome/css/font-awesome.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
	$(document).ready(function(){
	$("#form_content").submit(function(){
		$("#acecontent_alert").show();
		$("#acecontent_btn").attr('disabled','disabled');
	$.ajax({
	dataType: "json",
	url: "<?php bloginfo('url');?>/wp-content/plugins/ace_contact/process_contact.php",   	
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
<h1>Contact</h1>
<div class="head">
</div>
<?php
include('../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db=mysql_select_db(DB_NAME,$con);
$select_data=mysql_query("select * from tbl_acecontact");
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
	<span >Name</span>
	<input type="text" class="form-control" placeholder="Name" name="name" id="name_val" value="<?php echo $res_data['name']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Phone</span>
	<input type="text" class="form-control" placeholder="Phone" name="phone" id="phone_val" value="<?php echo $res_data['phone']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Email</span>
	<input type="text" class="form-control" placeholder="Email" name="email" id="email_val" value="<?php echo $res_data['email']; ?>"  autofocus>  	 	
	</div>
    <div class="row">
	<span >Address</span>
    <textarea class="form-control"  name="address" id="address_val"  autofocus ><?php echo $res_data['address']; ?></textarea>	 	
	</div>
    <div class="row">
	<span >Tag Line</span>
	<input type="text" class="form-control" placeholder="Tag Line" name="tag_line" id="tag_line_val" value="<?php echo $res_data['tag_line']; ?>"  autofocus>  	 	
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
register_activation_hook(__FILE__,'ace_installContact');
register_deactivation_hook(__FILE__,'ace_deactivateContact');
add_action('admin_menu','ace_pageContact');
?>