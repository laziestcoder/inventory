<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
//echo "came here";
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['act'] == "1") {
    //echo "Data Received";

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $autoSave = $pro->newUser($name, $username, $password, $email, $role);
    echo $autoSave;

}else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['act'] == "edit") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $id = $_POST['userid'];
        //echo "came here";
        $autoSave = $pro->updateUser($name, $email, $role,$id);
        echo $autoSave;
}else{
    echo "Did not worked!!";
}

?>