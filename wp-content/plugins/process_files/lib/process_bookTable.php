<?php 
include('../../../../wp-config.php');
$con_name=$_REQUEST['con_fname'].' '.$_REQUEST['con_lname'];
$con_email=$_REQUEST['con_email'];
$con_phone=$_REQUEST['con_phone'];
$con_date=$_REQUEST['con_date'];
if($con_date==NULL || $con_date=="")
{
	$sendResponse=array("status"=>0,"message"=>"Please select date and time.","todo"=>"date");
	$task->sendResponse($sendResponse);
}
$con_guest=$_REQUEST['con_guest'];
$con_subject=$_REQUEST['con_subject'];
$to_email=$_REQUEST['con_toemail'];
$email_Array=array($to_email);
//Message
$messages='<table border="1" cellpadding="1" cellspacing="1">';
$messages.='<tr><th>Name: </th><td>'.$con_name.'</td></tr>';
$messages.='<tr><th>Email: </th><td>'.$con_email.'</td></tr>';
$messages.='<tr><th>Phone: </th><td>'.$con_phone.'</td></tr>';
$messages.='<tr><th>Booking Date: </th><td>'.$con_date.'</td></tr>';
$messages.='<tr><th>Number of Guest: </th><td>'.$con_guest.'</td></tr>';
$messages.='</table>';
//+++++++
/*foreach($email_Array as $email)
{
	$sent_Mail=$task->sendMail($con_name,$con_email,$email,$con_subject,$messages);	
}*/
$sent_Mail=1;
$sendResponse=array("status"=>$sent_Mail,"message"=>"Your query has been sent.","todo"=>0);
$task->sendResponse($sendResponse);
?>