<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');

	$pro =new Project();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$body = $_POST['body'];
		$checkref = $pro->checkAutoRef($body);
	}

?>