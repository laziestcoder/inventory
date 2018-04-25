<?php
include_once('../inc/address.php');
$ni = $add;
include_once ( $ni .'/inc/header.php');
/*include_once ('../lib/Database.php');
include_once ('../classes/Project.php');*/
/*$db = new Database();
$pro = new Project();*/
?>


<!--included extra files-->
<!--<script src="js/jquery-2.0.3.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--include extra files-->

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<!--<script src="js/check.js"></script>-->
<link rel="stylesheet" type="text/css" href="css/main.css">


<div id="menu" class="width">
    <ul id="menuli">
        <li ><a href="<?php echo $ni.'/index.php';?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo $ni.'/new-item';?>" title="New Item"><i class="fa fa-plus"></i> New Item</a></li>
        <li><a href="<?php echo $ni.'/items';?>" title="Items"><i class="fa fa-list-ul"></i> Items</a></li>
        <li class="active"><a href="<?php echo $ni.'/check-in';?>" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In Item</a></li>
        <li><a href="<?php echo $ni.'/check-out';?>" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out Item</a></li>
        <li><a href="<?php echo $ni.'/log';?>" title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li><a href="<?php echo $ni.'/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
    </ul>
</div>

<div class="wrapper-pad">
    <h2 class="noborder">Check-In Item</h2>
    <span class="downtitle">Click an item to check-in...</span>
    <div id="table-head">
        <form method="post" action="" name="searchf">
            <input name="search" placeholder="Search..." class="search fleft" type="text">
        </form>
        <img src="../media/img/loader-small.gif" alt="loading" class="fleft loader" width="15px" height="15px">
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
    </div>
    <div id="checkInData"></div>
    <div id="error"></div>
</div>
<div id="pagination">
    <div class="page">1</div>
    <div class="next" name="2"><i class="fa fa-caret-right"></i></div>
</div>
<div class="clear" style="margin-bottom:40px;"></div>


<?php
include_once ($ni . '/inc/footer.php');
?>


</body>
</html>