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

        <li class="active"><a href="<?php echo $ni . '/items'; ?>" title="Items"><i class="fa fa-list-ul"></i> Items</a>
        </li>
        <li><a href="<?php echo $ni . '/check-in'; ?>" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In
                Item</a></li>
        <li><a href="<?php echo $ni . '/check-out'; ?>" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out
                Item</a></li>

        <li><a href="<?php echo $ni . '/log'; ?>" title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li><a href="<?php echo $ni . '/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a>
        </li>
    </ul>
</div>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
//if ($_SERVER['REQUEST_METHOD' == "GET"]) {
    $id = $_GET['id'];

    $item = $pro->getItemInfo($id);
    $catId = $item['category'];
//echo "Cat Id ".$catId;
    $cat = $pro->getCategoryInfo($catId);
    $catList = $pro->Category();
//}

?>

<div class="wrapper-pad">
    <h2>Edit Item (ID <?php echo $id; ?>)</h2>
    <div class="center">
        <div class="new-item form">
            <form method="post" action="" name="edit-item" data-id="<?php echo $id; ?>">
                Item Name:<br>
                <div class="ni-cont">
                    <input name="item-name" class="ni" value="<?php echo $item['name']; ?>" type="text">
                </div>
                <span class="item-desc-left">Description: (400 characters left)</span><br>
                <div class="ni-cont">
                    <textarea name="item-descrp" class="ni"><?php echo $item['description']; ?></textarea>
                </div>
                Category: ( <?php echo $cat['name']; ?> )<br>
                <div class="select-holder">

                    <select name="item-category" data-id="<?php echo $catId; ?>"><i class="fa fa-caret-down"></i>
                        <?php
                        if ($catList) {
                            //print_r($catList->fetch_assoc());
                            while ($catL = $catList->fetch_assoc()) {
                                echo "<option value='" . $catL['id'] . "'>" . $catL['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Add Some Category</option>";
                        }
                        ?>

                    </select>
                </div>
                Price of each item:<br>
                <input name="item-price" class="ni-small" placeholder="0.00" value="<?php echo $item['price']; ?>"
                       type="text">
                <input name="item-submit" class="ni btn blue" value="Save changes" type="submit">
            </form>
        </div>
    </div>
</div>

<div class="clear" style="margin-bottom:40px;"></div>

<?php
include_once($ni . '/inc/footer.php');
?>


</body>
</html>