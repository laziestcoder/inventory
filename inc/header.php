<?php
include_once('address.php');
//echo $add;
//define('__ROOT__', dirname(dirname(__FILE__)));
//$add = __ROOT__ ;
//require_once($add.'/lib/init.php');
$inc =$add;
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">

    <title>SI Inventory System</title>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <link rel="stylesheet" type="text/css" href="<?php echo $inc . '/css/site-forms.css';?>" >
    <link rel="stylesheet" type="text/css" href="<?php echo $inc . '/css/site-responsive.css';?>" >
    <link rel="stylesheet" type="text/css" href="<?php echo $inc . '/css/main.css';?>" >
    <?php
    /*include_once ($inc."/css/style.php");
    include_once ($inc."/css/style2.php");*/

    ?>


</head>
<body>
<div id="main-wrapper">
    <div class="" id="header">
        <div class="left">
            <a href="<?php echo $inc; ?>"><img src="<?php echo $inc . '/media/img/logo.png'; ?>"
                                               alt="Synchronise IT Inventory System" width="150" height="50"></a>
            <div style="font-size:12px; font-style:italic;color:#bbb;">Administrator</div><!--Get is using session-->
        </div>
        <div class="right">
            <a href="<?php echo $inc . '/users/'; ?> " title="Users">Users</a>| <a href="<?php echo $inc . '/settings/'; ?> " title="Settings">Settings</a>|
            <a href="<?php echo $inc . '/inc/logout.php'; ?> " title="Logout">Logout</a>
        </div>
        <div class="clear"></div>
    </div>

    <input class="toggle" id="opmenu" style="display:none" type="checkbox">