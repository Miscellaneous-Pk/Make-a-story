<?php 

header('Access-Control-Allow-Origin: *'); 

//echo $_POST['user-email'];

$link = mysqli_connect("localhost", "root", "", "mydb");

$myObj = new stdClass();

if (mysqli_connect_error()) {

	echo "Sorry Couldn't connect to the DB";

} else {

	$query = "SELECT * FROM users WHERE email = '" . $_POST['user-email'] . "'";

	$myObj->userRx = $_POST['user-email'];

	if ($result = mysqli_query($link, $query)) {

		$row = mysqli_fetch_assoc($result);

		if ($row > 0) {

			$myObj->name = $row['name'];
			$myObj->email = $row['email'];
			
			echo 'false';

		} else {

			$myObj->error = 'no data found in database';
			
			echo 'true';

		}

	} else {

		$myObj->error = "something wrong with query" . mysqli_error($link) ;
		
		echo 'false';

	}

}

//$myJSON = json_encode($myObj);
//
//echo $myJSON;

?>

