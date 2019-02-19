<?php
include('../../../../wp-config.php');
include_once("config.php");
$task=new operations();
$menu_category=explode("|",$_REQUEST['menu_category']);
$_REQUEST['menu_category']=$menu_category[1];
$_REQUEST['menu_category_id']=$menu_category[0];
$menu_subcategory=explode("|",$_REQUEST['menu_subcategory']);
$_REQUEST['menu_subcategory']=$menu_subcategory[1];
$_REQUEST['menu_subcategory_id']=$menu_subcategory[0];
$_REQUEST['menu_ingredients']=implode("|",$_REQUEST['menu_ingredients']);
switch($_REQUEST['action']){
	case 1:{
				if($task->getCount("select id from lrn_menu where menu_name='".$_REQUEST['menu_name']."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Menu already exist.","todo"=>0);
				}
				else
				{
					$_REQUEST['menu_image']=time().'_'.$_FILES['menu_image']['name'];
					$from_path=$_FILES['menu_image']['tmp_name'];
					$to_path=__DIR__. '/menu_image/'.$_REQUEST['menu_image'];
					move_uploaded_file($from_path,$to_path);
					unset($_REQUEST['action']);
					$insert_result=$task->insertData("lrn_menu",$_REQUEST);
					$sendResponse=array("status"=>$insert_result,"message"=>"Menu has been added successfully.","todo"=>0);	
				}
		
		}
		break;
		case 2:{
				$menu_id=$_REQUEST['menu_id'];
				if($task->getCount("select id from lrn_menu where menu_name='".$_REQUEST['menu_name']."' and id!='".$menu_id."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Menu already exist.","todo"=>0);
				}
				else
				{
					if($_FILES['menu_image']['name']!=NULL || $_FILES['menu_image']['name']!="")
					{
						$file_Result=$task->queryWhere("lrn_menu",array('menu_image'),array("id"=>$menu_id));
						if($file_Result[0]['menu_image']!=NULL)
						{
							$path_for_old=__DIR__ .'/menu_image/'.$file_Result[0]['menu_image'];
							unlink($path_for_old);
						}
						$_REQUEST['menu_image']=time().'_'.$_FILES['menu_image']['name'];
						$from_path=$_FILES['menu_image']['tmp_name'];
						$to_path=__DIR__. '/menu_image/'.$_REQUEST['menu_image'];
						move_uploaded_file($from_path,$to_path);
					}
					else
					{
						$file_Result=$task->queryWhere("lrn_menu",array('menu_image'),array("id"=>$menu_id));
						$_REQUEST['menu_image']=$file_Result[0]['menu_image'];
					}
					unset($_REQUEST['action']);
					unset($_REQUEST['menu_id']);
					$result=$task->updateData("lrn_menu",$_REQUEST,array("id"=>$menu_id));
					$sendResponse=array("status"=>$result,"message"=>"Menu has been updated successfully.","todo"=>"update");	
				}
		}	
		break;
	
}
$task->sendResponse($sendResponse);
?>