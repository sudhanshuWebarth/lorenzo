<?php
include('../../../../wp-config.php');
include_once("config.php");
$task=new operations();
$menu_category=explode("|",$_REQUEST['menu_category']);
switch($_REQUEST['action']){
	case 1:{
				if($task->getCount("select id from lrn_menupdf where menu_pdf_name='".$_REQUEST['menu_pdf_name']."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"Already exist,please change the name.","todo"=>0);
				}
				else
				{
					$_REQUEST['menu_pdf']=time().'_'.$_FILES['menu_pdf']['name'];
					$from_path=$_FILES['menu_pdf']['tmp_name'];
					$to_path=__DIR__. '/menu_image/'.$_REQUEST['menu_pdf'];
					move_uploaded_file($from_path,$to_path);
					unset($_REQUEST['action']);
					$insert_result=$task->insertData("lrn_menupdf",$_REQUEST);
					$sendResponse=array("status"=>$insert_result,"message"=>"PDF Menu has been added successfully.","todo"=>0);	
				}
		
		}
		break;
		case 2:{
				$pdf_id=$_REQUEST['pdf_id'];
				if($task->getCount("select id from lrn_menupdf where menu_pdf_name='".$_REQUEST['menu_pdf_name']."' and id!='".$pdf_id."'")>0)
				{
					$sendResponse=array("status"=>0,"message"=>"PDF Menu already exist.","todo"=>0);
				}
				else
				{
					if($_FILES['menu_pdf']['name']!=NULL || $_FILES['menu_pdf']['name']!="")
					{
						$file_Result=$task->queryWhere("lrn_menupdf",array('menu_pdf'),array("id"=>$pdf_id));
						if($file_Result[0]['menu_pdf']!=NULL)
						{
							$path_for_old=__DIR__ .'/menu_image/'.$file_Result[0]['menu_pdf'];
							unlink($path_for_old);
						}
						$_REQUEST['menu_pdf']=time().'_'.$_FILES['menu_pdf']['name'];
						$from_path=$_FILES['menu_pdf']['tmp_name'];
						$to_path=__DIR__. '/menu_image/'.$_REQUEST['menu_pdf'];
						move_uploaded_file($from_path,$to_path);
					}
					else
					{
						$file_Result=$task->queryWhere("lrn_menupdf",array('menu_pdf'),array("id"=>$pdf_id));
						$_REQUEST['menu_pdf']=$file_Result[0]['menu_pdf'];
					}
					unset($_REQUEST['action']);
					unset($_REQUEST['pdf_id']);
					$result=$task->updateData("lrn_menupdf",$_REQUEST,array("id"=>$pdf_id));
					$sendResponse=array("status"=>$result,"message"=>"PDF Menu has been updated successfully.","todo"=>"update");	
				}
		}	
		break;
	
}
$task->sendResponse($sendResponse);
?>