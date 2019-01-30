<?php 

header('Access-Control-Allow-Origin: *'); 

$link = mysqli_connect("localhost", "root", "", "mydb");

$myObj = new stdClass();

if (mysqli_connect_error()) {

	$myObj->success = false;
	$myObj->error = "Couldn't connect to database";

} 

if (isset($_POST["forgot-email-name"])) {

	if (filter_var($_POST["forgot-email-name"], FILTER_VALIDATE_EMAIL)) {

		$email = $_POST["forgot-email-name"];

		// Check to see if a user exists with this e-mail

		$query = "SELECT * FROM users WHERE email = '" . $email . "'";

		if ($result = mysqli_query($link, $query)) {

			$row = mysqli_fetch_assoc($result);

			if ($row > 0) {

				$myObj->success = true;

				// Create a unique salt. This will never leave PHP unencrypted.
				$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

				// Create the unique user password reset key
				$password = hash('sha512', $salt.$row["email"]);

				// Create a url which we will direct them to reset their passwordvar1=value1&var2=value2&var3=value3
				$pwrurl = "www.localhost/themepic/reset_password.php?q=".$password."&e=".$row["email"];

				// Mail them their key
				$mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.yoursitehere.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";

				$myObj->mailresponse = mail($row['email'], "www.themedphoto.com - Password Reset", $mailbody);
				$myObj->sentlink = $pwrurl;
				$myObj->email = $row['email'];
				$myObj->status = 'Email sent to your email address';

			} else {

				$myObj->success = false;
				$myObj->error = 'No such email is registered previously';

			}

		} else {

			$myObj->success = false;
			$myObj->error = "something wrong with query" . mysqli_error($link) ;

		}

	} else {

		$myObj->success = false;
		$myObj->error = "Email is not valid";

	}
	
}

$myJSON = json_encode($myObj);
echo $myJSON;

exit;

?>

