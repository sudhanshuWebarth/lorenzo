<?php
include('../../../../wp-config.php');
include_once("config.php");
$task=new operations();
$category_name=mysql_real_escape_string($_REQUEST['category_name']);
$category_tag=mysql_real_escape_string($_REQUEST['category_tag']);
$action=$_REQUEST['action'];
switch($action)
{
	case 1:{
				if($task->getCount("select id from lrn_category where category_name='".$category_name."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Category already exist.","todo"=>0);
				}
				else
				{
					$category_image=time().'_'.$_FILES['category_image']['name'];
					$from_path=$_FILES['category_image']['tmp_name'];
					$to_path=__DIR__. '/menu_image/'.$category_image;
					move_uploaded_file($from_path,$to_path);
					$result=$task->insertData("lrn_category",array("category_name"=>$category_name,"category_tag"=>$category_tag,"category_image"=>$category_image));
					$sendResponse=array("status"=>$result,"message"=>"Category has been added successfully.","todo"=>0);
				}
		
		}
		break;
	case 2:{
				$category_id=$_REQUEST['category_id'];
				if($task->getCount("select id from lrn_category where category_name='".$category_name."' and id!='".$category_id."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Category allready exist.","todo"=>0);
				}
				else
				{
					if($_FILES['category_image']['name']!=NULL || $_FILES['category_image']['name']!="")
					{
						$file_Result=$task->queryWhere("lrn_category",array('category_image'),array("id"=>$category_id));
						if($file_Result[0]['category_image']!=NULL)
						{
							$path_for_old=__DIR__ .'/menu_image/'.$file_Result[0]['category_image'];
							unlink($path_for_old);
						}
						$category_image=time().'_'.$_FILES['category_image']['name'];
						$from_path=$_FILES['category_image']['tmp_name'];
						$to_path=__DIR__. '/menu_image/'.$category_image;
						move_uploaded_file($from_path,$to_path);
					}
					else
					{
						$file_Result=$task->queryWhere("lrn_category",array('category_image'),array("id"=>$category_id));
						$category_image=$file_Result[0]['category_image'];
					}
					$result=$task->updateData("lrn_category",array("category_name"=>$category_name,"category_tag"=>$category_tag,"category_image"=>$category_image),array("id"=>$category_id));
					$result=$task->updateData("lrn_menu",array("menu_category"=>$category_name),array("menu_category_id"=>$category_id));
					$sendResponse=array("status"=>$result,"message"=>"Category has been updated successfully.","todo"=>"update");	
				}
		}	
		break;
}
$task->sendResponse($sendResponse);
?>