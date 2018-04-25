<?php
include_once('../inc/address.php');
$ni = $add;
include_once ( $ni.'/inc/header.php');
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
        <li><a href="<?php echo $ni.'/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
    </ul>
</div>




<!--Invento-->
<div class="wrapper-pad">
    <h2>Users</h2>			<div id="table-head">
        <form method="post" action="" name="searchf">
            <input name="search" placeholder="Search..." class="search fleft" type="text">
        </form>
        <div class="fright">
            <div class="select-holder">

                <select name="show-per-page"><i class="fa fa-caret-down"></i>
                    <option value="25" selected="">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="500">500</option>
                </select>
            </div>
        </div>
        <div class="fright" style="height:5px; margin-right:55px;"></div>
        <a href="new-user.php" name="new-cat" class="btn blue fright"><i class="fa fa-plus"></i>New User</a>
    </div>



    <div id="userData"></div>

</div>
<div id="pagination">
    <div class="page">1</div>
    <br><br>
</div>


<!--Invento-->

<?php
include_once ($ni . '/inc/footer.php');
?>


</body>
</html>