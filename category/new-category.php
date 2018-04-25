<?php
include_once('../inc/address.php');
$ni = $add;
include_once ( $ni .'/inc/header.php');

?>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">

<div id="menu" class="width">
    <ul id="menuli">
        <li ><a href="<?php echo $ni.'/index.php';?>" title="Home"><i class="fa fa-home"></i> Home</a></li>

        <li><a href="<?php echo $ni.'/new-item';?>" title="New Item"><i class="fa fa-plus"></i> New Item</a></li>

        <li><a href="<?php echo $ni.'/items';?>" title="Items"><i class="fa fa-list-ul"></i> Items</a></li>
        <li><a href="<?php echo $ni.'/check-in';?>" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In Item</a></li>
        <li><a href="<?php echo $ni.'/check-out';?>" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out Item</a></li>

        <li><a href="<?php echo $ni.'/log';?>" title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li class="active"><a href="<?php echo $ni.'/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
    </ul>
</div>



<div class="wrapper-pad">
    <h2>New Category</h2>
    <div class="left">
        <div class="new-cat form">
            <form id="categoryForm" name="new-cat">
                Category Name:<br>
                <div class="ni-cont">
                    <input id="categoryName" name="ncat-name" class="ni" type="text">
                </div>
                Category Place:<br>
                <div class="ni-cont">
                    <input id="categoryPlace" name="ncat-place" class="ni" type="text">
                </div>
                <span class="ncat-desc-left">Description: (400 characters left)</span><br>
                <div class="ni-cont">
                    <textarea id="categoryDescription" name="ncat-descrp" class="ni"></textarea>
                </div>
                <input id="submit" name="nuser-submit" class="ni btn blue" value="Create new category" type="button">
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