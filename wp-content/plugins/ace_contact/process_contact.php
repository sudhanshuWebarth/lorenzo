<?php







include('../../../wp-config.php');







$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);



$db=mysql_select_db(DB_NAME,$con);



$action=$_REQUEST['action'];



if($action=='add')



{



	$name=$_REQUEST['name'];



	$phone=$_REQUEST['phone'];



	$email=$_REQUEST['email'];



	$address=$_REQUEST['address'];
	$tag_line=$_REQUEST['tag_line'];



$insert_query=mysql_query("insert into tbl_acecontact set name='".$name."',phone='".$phone."',email='".$email."',address='".$address."',tag_line='".$tag_line."'");







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

	

	$name=$_REQUEST['name'];



	$phone=$_REQUEST['phone'];



	$email=$_REQUEST['email'];



	$address=$_REQUEST['address'];
	$tag_line=$_REQUEST['tag_line'];

	$update=mysql_query("update tbl_acecontact set name='".$name."',phone='".$phone."',email='".$email."',address='".$address."',tag_line='".$tag_line."' where id='".$rowid."'");



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