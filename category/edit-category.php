<?php
include_once('../inc/address.php');
$ni = $add;
include_once($ni . '/inc/header.php');

?>

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/edit.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">

<div id="menu" class="width">
    <ul id="menuli">
        <li><a href="<?php echo $ni . '/index.php'; ?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo $ni . '/new-item'; ?>" title="New Item"><i class="fa fa-plus"></i> New Item</a></li>
        <li><a href="<?php echo $ni . '/items'; ?>" title="Items"><i class="fa fa-list-ul"></i> Items</a></li>
        <li><a href="<?php echo $ni . '/check-in'; ?>" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In
                Item</a></li>
        <li><a href="<?php echo $ni . '/check-out'; ?>" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out
                Item</a></li>
        <li><a href="<?php echo $ni . '/log'; ?>" title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li class="active"><a href="<?php echo $ni . '/category'; ?>" title="Categories"><i class="fa fa-folder"></i>
                Categories</a></li>
    </ul>
</div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
//if ($_SERVER['REQUEST_METHOD' == "GET"]) {
$id = $_GET['id'];

$cat = $pro->getCategoryInfo($id);
//$catId = $cat['category'];
//echo "Cat Id ".$catId;
//$cat = $pro->getCategoryInfo($catId);
//$catList = $pro->Category();
//}

?>
<div class="wrapper-pad">
    <h2>Edit Category (ID - <?php echo $cat['id']; ?>)</h2>
    <div class="center">
        <div class="form">
            <form method="post" action="" name="edit-cat" data-id="<?php echo $id; ?>">
                Category Name:<br>
                <div class="ni-cont">
                    <input name="ncat-name" class="ni" value="<?php echo $cat['name']; ?>" type="text">
                </div>
                Category Place:<br>
                <div class="ni-cont">
                    <input name="ncat-place" class="ni" value="<?php echo $cat['place']; ?>" type="text">
                </div>
                <span class="ncat-desc-left">Category Description (400 characters left):</span><br>
                <div class="ni-cont">
                    <textarea name="ncat-descrp" class="ni"><?php echo $cat['description']; ?></textarea>
                </div>
                <input name="ncat-submit" class="ni btn blue" value="Save category" type="submit">
            </form>
        </div>
    </div>
</div>
<div class="clear" style="margin-bottom:40px;"></div>

<!--Invento-->

<!--Invento -->


<?php
include_once($ni . '/inc/footer.php');
?>


</body>
</html>