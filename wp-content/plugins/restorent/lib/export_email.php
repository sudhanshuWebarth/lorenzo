<?php
include('../../../../wp-config.php');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db=mysql_select_db(DB_NAME,$con);
if (isset($w) && ($w==1))
{
	$file_type = "msword";
	$file_ending = "doc";
}else {
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
}
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=".date('d-m-Y').".$file_ending");
header("Pragma: no-cache");
header("Expires: 0");
 ?>


<?php


$DB_Server = DB_HOST;		
$DB_Username = DB_USER;				
$DB_Password = DB_PASSWORD;				
$DB_DBName = DB_NAME;			
$DB_TBLName = "lrn_newsletter";				
$sql = "Select con_email,con_date from $DB_TBLName";

//Optional: print out title to top of Excel or Word file with Timestamp
//for when file was generated:
//set $Use_Titel = 1 to generate title, 0 not to use title
$Use_Title = 1;
//define date for title: EDIT this to create the time-format you need
$now_date = date('m-d-Y H:i');
//define title for .doc or .xls file: EDIT this if you want
/*

Leave the connection info below as it is:
just edit the above.

(Editing of code past this point recommended only for advanced users.)
*/
//create MySQL connection
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password)
	or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database
$Db = @mysql_select_db($DB_DBName, $Connect)
	or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
//execute query
$result = @mysql_query($sql,$Connect)
	or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());

//if this parameter is included ($w=1), file returned will be in word format ('.doc')
//if parameter is not included, file returned will be in excel format ('.xls')
if (isset($w) && ($w==1))
{
	$file_type = "msword";
	$file_ending = "doc";
}else {
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
}
//header info for browser: determines file type ('.doc' or '.xls')


/*	Start of Formatting for Word or Excel	*/

if (isset($w) && ($w==1)) //check for $w again
{
	/*	FORMATTING FOR WORD DOCUMENTS ('.doc')   */
	//create title with timestamp:
	
	//define separator (defines columns in excel & tabs in word)
	$sep = "\n"; //new line character

	while($row = mysql_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
		//define field names
		$field_name = mysql_field_name($result,$j);
		//will show name of fields
		$schema_insert .= "$field_name:\t";
			if(!isset($row[$j])) {
				$schema_insert .= "NULL".$sep;
				}
			elseif ($row[$j] != "") {
				$schema_insert .= "$row[$j]".$sep;
				}
			else {
				$schema_insert .= "".$sep;
				}
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		//end of each mysql row
		//creates line to separate data from each MySQL table row
		print "\n----------------------------------------------------\n";
	}
}else{
	/*	FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
	//create title with timestamp:
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character

	//start of printing column names as names of MySQL fields
	echo "SN.\t";
	for ($i = 0; $i < mysql_num_fields($result); $i++)
	{
		
		$what= mysql_field_name($result,$i);
		if($what=='id')
		{
			echo "Subscriber id\t";
		}
		else if($what=='con_email')
		{
			echo "Subscriber Email\t";	
		}
		else if($what=='con_date')
		{
			echo "Subscription Date\t";	
		}
		
	}
	print("\n");
	//end of printing column names

	//start while loop to get data
$sn="1";
	while($row = mysql_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
			echo $sn.$sep;
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
			{
				
					$schema_insert .= "$row[$j]".$sep;
					
				

			}
			else
				$schema_insert .= "".$sep;
				
		}
		
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		//following fix suggested by Josue (thanks, Josue!)
		//this corrects output in excel when table fields contain \n or \r
		//these two characters are now replaced with a space
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		
		print(trim($schema_insert));
		print "\n";
		$sn++;
	}
	
}

?>


<?php /*_____________________END___OF___THE___CODE______________________


get more code from http://www.fundisom.com/phparadise/


___________________________________________________________________*/ ?>