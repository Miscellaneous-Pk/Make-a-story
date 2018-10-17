<?php 

header('Access-Control-Allow-Origin: *'); 

session_start();

$link = mysqli_connect("localhost", "root", "", "mydb");

$myObj = new stdClass();

if (mysqli_connect_error()) {

	$myObj->Success = false;
	$myObj->Reason = "Sorry Couldn't connect to the DB" . mysqli_error($link);

}

if (isset($_POST['user-pass'])) {

	$password = $_POST['user-pass'];

	// Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
	
	//hash and secure the password
	$password = hash('sha512', $salt.$password);

	$query = "INSERT INTO `users`(`name`, `password`, `email`) VALUES (

		'".mysqli_real_escape_string($link,$_POST['user-name'])."',
		'".mysqli_real_escape_string($link,$password)."',
		'".mysqli_real_escape_string($link,$_POST['user-email'])."'

	)";

	if ($result = mysqli_query($link, $query)) {

		$_SESSION["idUser"] = mysqli_insert_id($link);
		$_SESSION["nameUser"] = $_POST['user-name'];

		header('Location: story_board.php');
        
        return;

	} else {

		$myObj->Success = false;
		$myObj->Reason = mysqli_error($link);

	} 

};

$myJSON = json_encode($myObj);

echo $myJSON;

?>

