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

if ($_POST['unsetSession'] == 'idPicture') {
	
	$value = $_POST['unsetSession'];
	
	unset($_SESSION[$value]);
	
	$myObj->sessionUnset = $value.' session is unset';
		
}

if (isset($_POST["img_link"]) || isset($_POST["thumbnail_link"])) {
	
	//	if picture is already in session -> update the picture else insert new picture and set up the session

	if (!(isset($_SESSION["idPicture"]))) {

		// Insert new in the picture table
		$sql = 'INSERT INTO `picture`(`img_cloudinary_link`, `users_idUsers`, `edit_status`, `img_thumbnail_link`) VALUES (
	"'.mysqli_real_escape_string($conn, $_POST["img_link"]).'",
	"'.mysqli_real_escape_string($conn, $_SESSION["idUser"]).'",
	"'.mysqli_real_escape_string($conn, $_POST['edit_status']).'",
	"'.mysqli_real_escape_string($conn, $_POST["thumbnail_link"]).'"
	)';

		if ($conn->query($sql) === TRUE) {

			$_SESSION["idPicture"] = mysqli_insert_id($conn);
			$myObj->success = true;
			$myObj->status = "New image saved successfully.";

			$conn->close();

		} else {

			$myObj->success = false;
			$myObj->error = "Err: ". $conn->error;
		}

	} else {
		
		$sql = 'UPDATE `picture` SET 
		
		`users_idUsers`="'.mysqli_real_escape_string($conn, $_SESSION["idUser"]).'",
		`edit_status`="'.mysqli_real_escape_string($conn, $_POST['edit_status']).'",
		`img_thumbnail_link`="'.mysqli_real_escape_string($conn, $_POST['thumbnail_link']).'"
		
		WHERE idPicture = "'.mysqli_real_escape_string($conn, $_SESSION["idPicture"]).'"';
		
		if ($conn->query($sql) === TRUE) {

			$myObj->success = true;
			$myObj->status = "Image thumbnail updated successfully.";
			$myObj->link2page = 'http://localhost/themepic/public_page.php?val='.$_SESSION["idPicture"];

			$conn->close();

		} else {

			$myObj->success = false;
			$myObj->error = "Err: Thbumbnail failed to upload ". $conn->error;
		}
		
	}

}




$myJSON = json_encode($myObj);
echo $myJSON;

exit;

?>

