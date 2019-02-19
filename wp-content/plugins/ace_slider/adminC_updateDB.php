<?php

include('../../../wp-config.php');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);

$db=mysql_select_db(DB_NAME,$con);

$action = mysql_real_escape_string($_POST['action']);

$updateRecordsArray = $_POST['recordsArrays'];



if ($action == "updateRecordsListings"){



	$listingCounter = 1;

	foreach ($updateRecordsArray as $recordIDValue) {



		$query = "UPDATE tbl_aceslider SET image_id = " . $listingCounter . " WHERE id = " . $recordIDValue;

		$update=mysql_query($query) or die('Error, insert query failed');

		$listingCounter = $listingCounter + 1;

		if($update)

		{

			echo "done";

		}

		else

		{

			echo "not done";	

		}

	}



	echo '<pre>';

	print_r($updateRecordsArray);

	echo '</pre>';

	echo 'If you refresh the page, you will see that records will stay just as you modified.';

}

?>