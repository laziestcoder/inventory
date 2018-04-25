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


<div class="wrapper-pad">
    <h2>New User</h2>
    <div class="center">
        <div class="new-item form">
            <form id="newUser" method="post" action="" name="new-user">
                Name:<br>
                <div class="ni-cont">
                    <input name="nuser-name" class="ni" type="text">
                </div>
                Username:<br>
                <div class="ni-cont">
                    <input name="nuser-user" class="ni" type="text">
                </div>
                Password:<br>
                <div class="ni-cont">
                    <input name="nuser-pass" class="ni" type="password">
                </div>
                Repeat Password:<br>
                <div class="ni-cont">
                    <input name="nuser-passr" class="ni" type="password">
                </div>
                Email:<br>
                <div class="ni-cont">
                    <input name="nuser-email" class="ni" type="text">
                </div>
                Role:<br>
                <div class="select-holder">

                    <select name="nuser-role"><i class="fa fa-caret-down" ></i>
                        <option value="1">Administrator</option>
                        <option value="2">General Supervisor</option>
                        <option value="3">Supervisor</option>
                        <option value="4">Employee</option></select>
                </div>
                <input name="nuser-submit" class="ni btn blue" value="Create new user" type="submit">
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>




<?php
include_once ($ni . '/inc/footer.php');
?>


</body>
</html>