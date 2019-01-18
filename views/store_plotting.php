<?php

header('Access-Control-Allow-Origin: *'); 

error_reporting(E_ERROR | E_PARSE);

session_start();

$conn = new mysqli("localhost", "root", "", "mydb");

$myObj = new stdClass();

if ($conn->connect_error) {

	$myObj->success = false;
	$myObj->error = "Couldn't connect to database".$conn->connect_error;

}

if (isset($_POST["elem"])) {
	
	$deletesql = 'DELETE FROM `plotting_data` WHERE `id_pic`= "'.$_SESSION["idPicture"].'"';

	if ($conn->query($deletesql) === TRUE) {
 
		$myObj->success = true;
		$myObj->status = "Previous circles deleted.";

	} else {

		$myObj->success = false;
		$myObj->error = "Something went wrong with upload query. Please try again later.". $conn->error;
	}

	$array = $_POST['elem'];

	foreach ($array as $value) {

		$sql = 'INSERT INTO `plotting_data`(`data`, `html`, `comment`, `id_pic`) VALUES (
	"'.mysqli_real_escape_string($conn, json_encode($value['data'])).'",
	"'.mysqli_real_escape_string($conn, $value['label']).'",
	"'.mysqli_real_escape_string($conn, $value['comment']).'",
	"'.mysqli_real_escape_string($conn, $_SESSION["idPicture"]).'"
	)';

		if ($conn->query($sql) === TRUE) {

			$myObj->success = true;
			$myObj->status = "Data saved successfully.";



		} else {

			$myObj->success = false;
			$myObj->error = "Something went wrong with upload query. Please try again later.". $conn->error;
		}

	}

	$conn->close();

}


$myJSON = json_encode($myObj);
echo $myJSON;

exit;

?>