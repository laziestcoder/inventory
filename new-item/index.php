<?php
include_once('../inc/address.php');
$ni = $add;
include_once ( $ni .'../inc/header.php');
include_once ('../lib/init.php');
$query = $pro->Category();
if($query)
{
//echo "done";
//$row = mysqli_fetch_assoc($query);


?>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<div id="menu" class="width">
    <ul id="menuli">
        <li ><a href="<?php echo $ni.'/index.php';?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="<?php echo $ni.'index.php';?>" title="New Item"><i class="fa fa-plus"></i> New Item</a></li>
        <li><a href="<?php echo $ni.'/items';?>" title="Items"><i class="fa fa-list-ul"></i> Items</a></li>
        <li><a href="<?php echo $ni.'/check-in';?>" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In Item</a></li>
        <li><a href="<?php echo $ni.'/check-out';?>" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out Item</a></li>
        <li><a href="<?php echo $ni.'/log';?>" title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li><a href="<?php echo $ni.'/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
    </ul>
</div>

<div class="wrapper-pad">
    <h2>New Item</h2>
    <div class="clear">
        <div class="new-item form">
            <form method="post" action="" name="new-item" >
                Item Name:
                <br>
                <div class="ni-cont">
                    <input id="item" name="item-name" class="ni" type="text">
                </div>

                <span class="item-desc-left">Description: (400 characters left)</span>
                <br>
                <div class="ni-cont">
                    <textarea id="itemDescription" name="item-descrp" class="ni"></textarea>
                </div>

                Category:
                <div class="select-holder">

                    <select id ="itemCategory" name="item-category"><i class="fa fa-caret-down"></i>
                        <option value=''  selected="" disabled="">Select Category</option>
                    <?php
                        foreach ($query as $category) {
                            echo "<option value='".$category['id']."'>" . $category['name'] . "</option>";
                        }
                        } else {
                            echo "<option value=''>NO CATEGORY INSERTED</option>";
                        }
                    ?>
                    </select>
                </div>
                Quantity:
                <br>
                <input id="quantity" name="item-qty" class="ni-small" placeholder="0" type="text">
                Price of each item:
                <br>
                <input id="price" name="item-price" class="ni-small" placeholder="0.00" type="text">
                <input id="submit" name="item-submit" class="ni btn blue" value="Create new item" type="button">
                <br>
            </form>
        </div>
    </div>
</div>
<div class="clear" style="margin-bottom:40px;"></div>

<?php
include_once ($ni . '/inc/footer.php');
?>

</body>
</html>