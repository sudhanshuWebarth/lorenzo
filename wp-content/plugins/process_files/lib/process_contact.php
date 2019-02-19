<?php 
$url="http://".$_SERVER['HTTP_HOST']."/lorenzo/contact/";
if (!isset($_SERVER['HTTP_REFERER'])) {
     die ('<h2>Direct File Access NOT allowed</h2>');
}
else if($url==$_SERVER['HTTP_REFERER'])
{
include('../../../../wp-config.php');
$con_name=$_POST['con_name'];
$con_email=$_POST['con_email'];
$con_phone=$_POST['con_phone'];
$con_message=$_POST['con_message'];
$con_subject=$_POST['con_subject'];
$to_email=$_POST['con_toemail'];
$email_Array=array($to_email);
//Message
$messages='<table border="1" cellpadding="1" cellspacing="1">';
$messages.='<tr><th>Name: </th><td>'.$con_name.'</td></tr>';
$messages.='<tr><th>Email: </th><td>'.$con_email.'</td></tr>';
$messages.='<tr><th>Phone: </th><td>'.$con_phone.'</td></tr>';
$messages.='<tr><th>Message: </th><td>'.$con_message.'</td></tr>';
$messages.='</table>';
//+++++++
foreach($email_Array as $email)
{
	$sent_Mail=$task->sendMail($con_name,$con_email,$email,$con_subject,$messages);	
}
//$sent_Mail=1;
$sendResponse=array("status"=>$sent_Mail,"message"=>"Your query has been sent.","todo"=>0);
$task->sendResponse($sendResponse);
}
?>