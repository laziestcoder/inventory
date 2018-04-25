<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Project.php');

$pro =new Project();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //echo "Data Received";
    if ($_POST['act'] == "add") {
        $name = $_POST['name'];
        $place = $_POST['place'];
        $description = $_POST['description'];
        $autoSave = $pro->newCategory($name, $place, $description);
    }

    if ($_POST['act'] == "edit") {
        //echo "came here";
        $id = $_POST['catid'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $place = $_POST['place'];
        //echo $place;
        $autoSave = $pro->updateCategoryInfo($id, $name, $desc, $place);
        echo $autoSave;
    }
}

?>