<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');

	$pro =new Project();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$content = $_POST['contentName'];
		$contentid = $_POST['contentId'];
		$autoSave = $pro->autoSave($content,$contentid);
	}

?>