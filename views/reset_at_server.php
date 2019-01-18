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

if (isset($_POST["hash"]) && isset($_POST["in-email"])) {

	// Gather the post data
	$email = $_POST["in-email"];
	$password = $_POST["in-pass"];
	$confirmpassword = $_POST["in-pass-confirm"];
	$hash = $_POST["hash"];

	// Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

	// Generate the reset key
	$resetkey = hash('sha512', $salt.$email);

	// Does the new reset key match the old one?
	if ($resetkey == $hash) {

		if ($password == $confirmpassword){

			//has and secure the password
			$password = hash('sha512', $salt.$password);

			// Update the user's password
			$sql = 'UPDATE users SET password = "'.mysqli_real_escape_string($conn,$password).'" WHERE email = "'.$email.'"';

			if ($conn->query($sql) === TRUE) {
				$myObj->success = true;
				$myObj->status = "Your password has been changed successfully.";

				$conn->close();
			} else {

				$myObj->success = false;
				$myObj->error = "Something went wrong with upload query. Please try again later.". $conn->error;
			}

		} else {

			$myObj->success = false;
			$myObj->error = "Password didn't match";

		}

	} else {

		$myObj->success = false;
		$myObj->error = "Invalid reset link. Check your inbox for correct reset link.";

	}

}

$myJSON = json_encode($myObj);
echo $myJSON;

exit;

?>

