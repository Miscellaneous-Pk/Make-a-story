<?php 

header('Access-Control-Allow-Origin: *'); 
header("HTTP/1.1 200 OK");
error_reporting(E_ERROR | E_PARSE);

//echo $_POST['user-email'];

$link = mysqli_connect("localhost", "root", "", "mydb");

$myObj = new stdClass();

if (mysqli_connect_error()) {
 
	$myObj->success = false;
    $myObj->error = "Sorry couldn't connect to the DB." ;

} else {

	$query = "SELECT * FROM users WHERE email = '" . $_POST['in-email'] . "'";

	if ($result = mysqli_query($link, $query)) {

		$row = mysqli_fetch_assoc($result);
			
		if ($row > 0) {
			
			$password = $_POST['in-pass'];

			// Use the same salt from the forgot_password.php file
			$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

			//has and secure the password
			$password = hash('sha512', $salt.$password);
			
			if ($row['password'] == $password) {
				
				$myObj->success = true;
				$myObj->id = $row['idUsers'];
				$myObj->name = $row['name'];
				
			} else {
				
				$myObj->rowPassword = $row['password'];
				$myObj->Password = $password;

				$myObj->success = false;
				$myObj->error = "Password didn't match";
				
			}

		} else {

			$myObj->success = false;
			$myObj->error = "Email and password didn't match";

		}

	} else {

		$myObj->success = false;
		$myObj->error = "Something went wrong: " . mysqli_error($link) ;

	}

}

$myJSON = json_encode($myObj);

echo $myJSON;

?>

