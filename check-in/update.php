<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Project.php');

$pro = new Project();
if($_SERVER["REQUEST_METHOD"]=="POST") {
    //echo "came to me!";
    $prev=$_POST['fromval'];
    $val=$_POST['val'];
    $id=$_POST['id'];
    $chk=$_POST['act'];
    $pro->updateItem($val,$prev,$id,$chk);
}


?>