<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
//echo "came here";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['act'] == "newItem") {
        //echo "came here";
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $autoSave = $pro->newItem($name, $category, $description, $quantity, $price);
        //echo $autoSave;
    }

    if ($_POST['act'] == "edit") {
        //echo "came here";
        $id = $_POST['itemid'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $cat = $_POST['cat'];
        $price= $_POST['price'];
        $autoSave = $pro->updateItemInfo($id, $name, $desc, $cat, $price);
        echo $autoSave;
    }
}

?>