<?php
class  operations{
private $query;
private $data;
private $host;
private $user;
private $password;
private $db;
private $connect;
public function operations()
{
	$this->host=DB_HOST;$this->user=DB_USER;$this->password=DB_PASSWORD;$this->db=DB_NAME;
	$this->connect=mysql_connect($this->host,$this->user,$this->password);	
	mysql_select_db($this->db,$this->connect);
}
public function customDate($format)
{
	date_default_timezone_set("Asia/Kolkata");
	$timezone=date_default_timezone_get();
	return $todayDate=date($format);	
}

public function sendMail($con_name,$con_email,$email,$subject,$messages)
{
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: ".strip_tags($con_name)." <".strip_tags($con_email).">\r\n";
	$headers .= "Reply-To:<".strip_tags($con_email).">\r\n"; 
	$headers .= "Return-Path:<".strip_tags($con_email).">\r\n";
	$headers .= "X-Priority: 3\r\n";
	$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
	if(mail($email,$subject,$messages,$headers)){return 1;}else{return 0;}
}

public function sendResponse($data){
	$this->data=$data;
	echo json_encode($this->data); 
	exit();
	}

public function query($query){
$this->query=$query;
if(mysql_query($this->query)){$result=1;}else{$result=0;}
return $result;
}

public function queryWhere($tbl_name,$fiels,$where){
	$string="select ".implode(",",$fiels)." from ".$tbl_name;
	
	if(count($where)>0)
	{
	$whereSring=" where";
	$sn=1;
	foreach($where as $key => $item){
		if($sn==1){$whereSring.=" ".$key."='".$item."'";}
		else{$whereSring.=" and ".$key."='".$item."'";}
		$sn++;
	}
	$string.=$whereSring;
	}
	else{$whereSring="";$string.=$whereSring;}
	if($this->getCount($string)>0)
	{
		$result=$this->getData($string);
	}
	else
	{
		$result=0;
	}
	return $result;
}
public function queryWhereCustom($tbl_name,$fiels,$custom_string){
	$string="select ".implode(",",$fiels)." from ".$tbl_name;
	$string.=" ".$custom_string;
	if($this->getCount($string)>0)
	{
		$result=$this->getData($string);
	}
	else
	{
		$result=0;
	}
	return $result;
	//return $string;
}
public function getCount($string)
{
	$qq=mysql_query($string);
	$count=mysql_num_rows($qq);
	return $count;
}
public function getData($string)
{
	$query1=mysql_query($string);
	$bktData=array();
	while($resData=mysql_fetch_array($query1, MYSQL_ASSOC))
	{
		array_push($bktData,$resData);
	}
	return $bktData;
}
public function insertData($tbl_name,$fiels)
{
	$string="insert into ".$tbl_name." set";
	$sn=1;	
	foreach($fiels as $key => $field)
	{
		$string.=" ".$key."='".$field."'";
		if($sn<count($fiels))
		{
			$string.=",";
		}
		$sn++;
	}
	$result=$this->query($string);
	return $result;
}
public function updateData($tbl_name,$fiels,$where)
{
	$string="update ".$tbl_name." set";
	$sn=1;	
	foreach($fiels as $key => $field)
	{
		$string.=" ".$key."='".$field."'";
		if($sn<count($fiels))
		{
			$string.=",";
		}
		$sn++;
	}
	if(count($where)>0)
	{
	$whereSring=" where";
	$sno=1;
	foreach($where as $key => $item){
		if($sno==1){$whereSring.=" ".$key."='".$item."'";}
		else{$whereSring.=" and ".$key."='".$item."'";}
		$sno++;
	}
	$string.=$whereSring;
	}
	else{$whereSring="";$string.=$whereSring;}
	$result=$this->query($string);
	return $result;
}
public function delete($tbl_name,$where)
{
	$string="delete from ".$tbl_name;
	if(count($where)>0)
	{
	$whereSring=" where";
	$sno=1;
	foreach($where as $key => $item){
		if($sno==1){$whereSring.=" ".$key."='".$item."'";}
		else{$whereSring.=" and ".$key."='".$item."'";}
		$sno++;
	}
	$string.=$whereSring;
	}
	else{$whereSring="";$string.=$whereSring;}
	$result=$this->query($string);
	return $result;
}
//END CLASS	
}
?>