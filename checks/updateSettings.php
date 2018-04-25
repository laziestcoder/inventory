<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
//echo "came here";
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['act'] == "emailName") {
    //echo "Data Received";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['userid'];
    $autoSave = $pro->updateEmailName($name, $email, $id);
    echo $autoSave;

}else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['act'] == "password") {

    $password = $_POST['password'];
    $id = $_POST['userid'];
    //echo "came here";
    $autoSave = $pro->updateUserPassword($password,$id);
    echo $autoSave;
}else{
    echo "Did not worked!!";
}

?>