<?php
include('../../../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db=mysql_select_db(DB_NAME,$con);
$action=$_REQUEST['action'];
if($action=='add')
{
$facebook=$_REQUEST['facebook'];
$twitter=$_REQUEST['twitter'];
$google_plus=$_REQUEST['google_plus'];
$youtube=$_REQUEST['youtube'];
$instagram=$_REQUEST['instagram'];
$insert_query=mysql_query("insert into tbl_acesocial set facebook='".$facebook."',twitter='".$twitter."',google_plus='".$google_plus."',youtube='".$youtube."',instagram='".$instagram."'");
if($insert_query)
{

$result='inserted';
}

else
{

$result='false';

}

$data=array('message'=>$result);

echo json_encode($data);
exit;
}
else if($action=='edit')
{

	$rowid=$_REQUEST['rowid'];

	$facebook=$_REQUEST['facebook'];

	$twitter=$_REQUEST['twitter'];

	$google_plus=$_REQUEST['google_plus'];

	$youtube=$_REQUEST['youtube'];
$instagram=$_REQUEST['instagram'];
	$update=mysql_query("update tbl_acesocial set facebook='".$facebook."',twitter='".$twitter."',google_plus='".$google_plus."',youtube='".$youtube."',instagram='".$instagram."' where id='".$rowid."'");

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



?>