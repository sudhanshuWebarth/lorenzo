<?php
include('../../../../wp-config.php');
include_once("config.php");
$task=new operations();
$subcategory_name=$_REQUEST['subcategory_name'];
$dish_type=$_REQUEST['dish_type'];
$action=$_REQUEST['action'];
switch($action)
{
	case 1:{
				if($task->getCount("select id from lrn_subcategory where subcategory_name='".$subcategory_name."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Sub Category already exist.","todo"=>0);
				}
				else
				{
					$result=$task->insertData("lrn_subcategory",array("subcategory_name"=>$subcategory_name,"dish_type"=>$dish_type));
					$sendResponse=array("status"=>$result,"message"=>"Sub Category has been added successfully.","todo"=>0);
				}
		
		}
		break;
	case 2:{
				$subcategory_id=$_REQUEST['subcategory_id'];
				if($task->getCount("select id from lrn_subcategory where subcategory_name='".$subcategory_name."' and id!='".$subcategory_id."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Sub Category already exist.","todo"=>0);
				}
				else
				{
					$result=$task->updateData("lrn_subcategory",array("subcategory_name"=>$subcategory_name,"dish_type"=>$dish_type),array("id"=>$subcategory_id));
					$result=$task->updateData("lrn_menu",array("menu_subcategory"=>$subcategory_name),array("menu_subcategory_id"=>$subcategory_id));
					$sendResponse=array("status"=>$result,"message"=>"Sub Category has been updated successfully.","todo"=>"update");
				}
		}	
		break;
}
$task->sendResponse($sendResponse);
?>