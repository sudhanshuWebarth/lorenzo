<?php
include('../../../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);

$db=mysql_select_db(DB_NAME,$con);

$action=$_REQUEST['action'];

if($action=='add')

{

	$title=$_REQUEST['title'];



if($_FILES['filename']['name'])



{



	$image_name=time().'_'.$_FILES['filename']['name'];



	$from_path=$_FILES['filename']['tmp_name'];



	$to_path= __DIR__ . '/gallery_images/'.$image_name;



	move_uploaded_file($from_path,$to_path);



	$gall_Sel=mysql_query("select id from tbl_aceslider");



	$put_Count=mysql_num_rows($gall_Sel);
if($put_Count<=0)
{
	$image_id=$put_Count+1;
}
else
{
	$gall_Sel=mysql_query("select image_id from tbl_aceslider order by image_id desc limit 1");
	$res=mysql_fetch_array($gall_Sel);
	$image_id=$res['image_id']+1;
}



	$insert_query=mysql_query("insert into tbl_aceslider set title='".$title."',image='".$image_name."',image_id='".$image_id."'");



	if($insert_query)



	{



		$result='inserted';



	}



	else



	{



		$result='false';



	}



}



else



{



	$result='blank';



}















$data=array('message'=>$result);



echo json_encode($data);



exit;



}

else if($action=='edit')

{

	$title=$_REQUEST['title'];

	$rowid=$_REQUEST['rowid'];

	$chk_image=mysql_fetch_array(mysql_query("select image from tbl_aceslider where id='".$rowid."'"));

	//file update

if($_FILES['filename']['name']!="")

{

	$old_file=$chk_image['image'];

	$path_for_old=__DIR__ . '/gallery_images/'.$old_file;

	unlink($path_for_old);

	$image_name=time().'_'.$_FILES['filename']['name'];

	$from_path=$_FILES['filename']['tmp_name'];

	$to_path= __DIR__ . '/gallery_images/'.$image_name;

	move_uploaded_file($from_path,$to_path);

	$update=mysql_query("update tbl_aceslider set image='".$image_name."' where id='".$rowid."'");

}

	//End file update

	$update=mysql_query("update tbl_aceslider set title='".$title."' where id='".$rowid."'");

	if($update)



	{



		$result='updated';



	}



	else



	{



		$result='false';



	}

		$data=array('message'=>$result);

		

		echo json_encode($data);

		

		exit;

}

else if($action=='deleted')

{

	$rowid=$_REQUEST['rowid'];

	$chk_image=mysql_fetch_array(mysql_query("select image from tbl_aceslider where id='".$rowid."'"));

	$old_file=$chk_image['image'];

	$path_for_old=__DIR__ . '/gallery_images/'.$old_file;

	unlink($path_for_old);

	$delete=mysql_query("delete from tbl_aceslider where id='".$rowid."'");

	if($delete)



	{



		echo 'deleted';



	}



	else



	{



		echo 'false';



	}

	

}



?>