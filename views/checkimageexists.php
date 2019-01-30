<?php 

header('Access-Control-Allow-Origin: *'); 

//error_reporting(E_ERROR | E_PARSE);

$link = new stdClass();

$external_link = $_POST['link'];

list($width, $height) = $external_link;

$link->dims = " width: $width <br />height: $height ";

if (@getimagesize($external_link)) {
	
	$link->success = 'true';
	$link->value = @getimagesize($external_link);
	$link->elink = $external_link;
	
} else {
	
	$link->success = 'false';
	$link->value = @getimagesize($external_link);
	$link->elink = $external_link;
	
}

$myJSON = json_encode($link);
echo $myJSON;

exit;

?>