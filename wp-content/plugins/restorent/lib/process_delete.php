<?php
include('../../../../wp-config.php');
include_once("config.php");
$task=new operations();
$table_name=$_REQUEST['table_name'];
$row_id=$_REQUEST['row_id'];
$tbl_Array=array('lrn_menu','lrn_category','lrn_menupdf');
if(in_array($table_name,$tbl_Array))
{
	if($table_name=='lrn_menu')
	{
		$image_field='menu_image';
	}
	else if($table_name=='lrn_category')
	{
		$image_field='category_image';
		$result=$task->updateData("lrn_menu",array("menu_category"=>"Uncategorised","menu_category_id"=>0),array("menu_category_id"=>$row_id));
	}
	else if($table_name=='lrn_menupdf')
	{
		$image_field='menu_pdf';
	}
	$file_Result=$task->queryWhere($table_name,array($image_field),array("id"=>$row_id));
	if($file_Result[0][$image_field]!=NULL)
	{
		$path_for_old=__DIR__ .'/menu_image/'.$file_Result[0]['menu_image'];
		unlink($path_for_old);
	}
}
if($table_name=='lrn_subcategory')
	{
		$result=$task->updateData("lrn_menu",array("menu_subcategory"=>"Uncategorised","menu_subcategory_id"=>0),array("menu_subcategory_id"=>$row_id));
	}
$delete_Result=$task->delete($table_name,array("id"=>$row_id));
$sendResponse=array("status"=>$delete_Result,"message"=>"Data has been deleted successfully.","todo"=>0);
$task->sendResponse($sendResponse);
?>