<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
//echo "came here";
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['act'] == "reqinfo") {
    //echo "Data Received";
    if($_POST['val']=='today'){
        $name = $_POST['val'];
    }else if($_POST['val']=='this_week'){
        $name = $_POST['val'];
    }else if($_POST['val']=='this_month'){
        $name = $_POST['val'];
    }else if($_POST['val']=='this_year'){
        $name = $_POST['val'];
    }else if($_POST['val']=='all_time'){
        $name = $_POST['val'];
    }
    //echo $name;
    $autoSave = $pro->home($name);
    echo $autoSave;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['act'] == "showInfo") {
    $auto = $pro->homeGeneral();
    echo $auto;
}


?>