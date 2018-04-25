<?php
require_once ('inc/header.php');
//$ni = dirname(__FILE__);
$ni = $add;
$sii = $add;
?>
<?php
/*session_start();
if(!$_SESSION['username']){
    //header("Location:login/index.php");
}
*/?>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>

<div id="menu">
    <ul id="menuli">
        <li class="active"><a href="<?php echo $ni.'/index.php';?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo $ni.'/new-item';?>" title="New Item"><i class="fa fa-plus"></i> New Item</a></li>
        <li><a href="<?php echo $ni.'/items';?>" title="Items"><i class="fa fa-list-ul"></i> Items</a></li>
        <li><a href="<?php echo $ni.'/check-in';?>" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In Item</a></li>
        <li><a href="<?php echo $ni.'/check-out';?>" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out Item</a></li>
        <li><a href="<?php echo $ni.'/log';?>" title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li><a href="<?php echo $ni.'/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
    </ul>
</div>

<!--php codes-->
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/classes/Project.php');
$pro = new Project();

//$pro->home("today");


?>

<div class="wrapper-pad">
    <h2>Home</h2>
    <ul id="selectors">
        <li class="selected" value="today">TODAY</li>
        <li value="this_week" class="">THIS WEEK</li>
        <li value="this_month" class="">THIS MONTH</li>
        <li value="this_year" class="">THIS YEAR</li>
        <li value="all_time" class="">ALL TIME</li>
    </ul>

    <div id="fdetails">
        <div class="element" style="margin-top:7px;">
            <span style="font-size:25px;display: inline-block;"></span><br>
            NEW<br>
            ITEMS
        </div>
        <div class="element" style="margin-top:7px;">
            <span style="font-size:25px;display: inline-block;"></span><br>
            CHECKED-IN<br>
            (QTY TOTAL)
        </div>
        <div class="element" style="margin-top:7px;">
            <span style="font-size:25px;display: inline-block;"></span><br>
            CHECKED-OUT<br>
            (QTY TOTAL)
        </div>
        <div class="element" style="margin-top:7px;">
            <span style="font-size:25px;display: inline-block;"></span><br>
            CHECKED-IN
        </div>
        <div class="element" style="margin-top:7px;">
            <span style="font-size:25px;display: inline-block;"></span><br>
            CHECKED-OUT
        </div>
    </div>
</div>
<div class="clear" style="margin-bottom:40px;height:1px;"></div>
<div class="border" style="margin-bottom:30px;"></div>

<!-- php code -->
<div class="wrapper-pad">
    <h3>GENERAL STATS</h3>
    <div id="f2details">
        <div class="element" style="margin-top:8px;">
            <span style="font-size:25px;"></span><br>
            REGISTERED<br>
            ITEMS
        </div>
        <div class="element" style="margin-top:8px;">
            <span style="font-size:25px;"></span><br>
            WAREHOUSE<br>
            ITEMS (QTY)
        </div>
        <div class="element" style="margin-top:8px;">
            <span style="font-size:25px;"></span><br>
            VALUE IN WAREHOUSE
        </div>
        <div class="element" style="margin-top:8px;">
            <span style="font-size:25px;"></span><br>
            VALUE CHECKED OUT
        </div>
    </div>
</div>
<div class="clear" style="margin-bottom:40px;"></div>

<?php
        include_once ( $sii .'/inc/footer.php');
?>


</body>
</html>