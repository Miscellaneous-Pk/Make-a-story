<?php 

header('Access-Control-Allow-Origin: *'); 

error_reporting(E_ERROR | E_PARSE);

session_start();

$conn = new mysqli("localhost", "root", "", "mydb");

$myObj = new stdClass();

if ($conn->connect_error) {

	$myObj->success = 'false';
	$myObj->error = "Couldn't connect to database".$conn->connect_error;

} else {

	unset($_SESSION['idPicture']);

	$sql = "SELECT * FROM `picture` WHERE `img_thumbnail_link` = '" . $_POST['link'] . "'";

	if ($result = mysqli_query($conn, $sql)) {

		$row = mysqli_fetch_array($result);

		$myObj->success = 'true';
		$_SESSION['idPicture'] = $row['idPicture'];
		$myObj->idPicture = $row['idPicture'];
		$myObj->img_cloudinary_link = $row['img_cloudinary_link'];
		$myObj->users_idUsers = $row['users_idUsers'];
		$myObj->edit_status = $row['edit_status'];

	} else {

		$myObj->success = 'false';
		$myObj->pictureError = mysqli_error($conn);

	}
	
	$datasql = "SELECT * FROM `plotting_data` WHERE id_pic = '".$_SESSION['idPicture']."'";
	
	if ($result = mysqli_query($conn, $datasql)) {
		
		$count = 0;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$myObj->success = 'true';
			$myObj->circledata->$count->rawdata = $row['data'];
			$myObj->circledata->$count->html = $row['html'];
			$myObj->circledata->$count->comment = $row['comment'];
			
			$count++;
			
//			$conn-close();
			
		}
		
	} else {

		$myObj->success = 'false';
		$myObj->dataError = mysqli_error($conn);

	}
	

}

$myJSON = json_encode($myObj);
echo $myJSON;

exit;

?>

