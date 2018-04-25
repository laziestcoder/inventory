<?php
 $filepath = realpath(dirname(__FILE__));
	include_once($filepath . '/../classes/Database.php');
	include_once ($filepath.'/../classes/Project.php');
	$db  = new Database();
	$pro = new Project();
?>

