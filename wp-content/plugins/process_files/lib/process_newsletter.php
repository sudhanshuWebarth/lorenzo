<?php
include('../../../../wp-config.php');
$con_name="Lorenzo";
$con_email=$_POST['con_email'];
$con_subject=$_POST['con_subject'];
if($task->getCount("select id from lrn_newsletter where con_email='".$con_email."'")>0)
{
	$sendResponse=array("status"=>0,"message"=>"Your email address already exist.","todo"=>0);
}
else
{
	$email_Array=array($con_email);
	//Message
	$messages='<table border="1" cellpadding="1" cellspacing="1">';
	$messages.='<tr><td>Hello, thankyou for your subscription.</td></tr>';
	$messages.='</table>';
	//+++++++
	/*foreach($email_Array as $email)
	{
	$sent_Mail=$task->sendMail($con_name,$con_email,$email,$con_subject,$messages);	
	}*/
	$_REQUEST['con_date']=$task->customDate("Y-m-d H:i");
	unset($_REQUEST['con_subject']);
	$insert_result=$task->insertData("lrn_newsletter",$_REQUEST);
	$sent_Mail=1;
	$sendResponse=array("status"=>$sent_Mail,"message"=>"Thankyou for your subscription.","todo"=>0);	
}
$task->sendResponse($sendResponse);
?>