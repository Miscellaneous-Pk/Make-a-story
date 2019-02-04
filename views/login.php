<?php 

header('Access-Control-Allow-Origin: *');

session_start();

$link = mysqli_connect("localhost", "root", "", "mydb");

$myObj = new stdClass();

if (mysqli_connect_error()) {

	$myObj->Success = 'false';
	$myObj->reason = mysqli_connect_error();

}

if (isset($_POST['in-email'])) {

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

				$_SESSION["idUser"] = $row['idUsers'];
				$_SESSION["nameUser"] = $row['name'];

				header('Location: story_board.php');

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
		$myObj->error = "Something went wrong:" . mysqli_error($link) ;

	}

} else {

	$myObj->Success = 'false';
	$myObj->email = $_POST['in-email']. $_POST['in-pass']. $_POST['in-pass-confirm']. $_POST['hash'];
	$myObj->reason = 'No email is recieved';

}

$myJSON = json_encode($myObj);

echo $myJSON;

?>
