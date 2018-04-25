<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');

	$pro =new Project();

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		//echo "Helo!";
        $user = $_POST['user'];
		$password = $_POST['pass'];
		//print_r($_POST);
		//echo "email=".$email.". Password=".$password.".<br>";
		$check = $pro->checkLogin($user,$password);
		var_dump($check);
		exit();
		/*if($check){
		    session_start();
		    $_SESSION['username']=$user;
        }
        else{
            session_start();
            $_SESSION['username']='';
        }*/
	}

?>