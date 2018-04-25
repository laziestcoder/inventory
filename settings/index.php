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

        <li><a href="<?php echo $ni.'/log';?>"title="Logs"><i class="fa fa-file-text-o"></i> Logs</a></li>
        <li><a href="<?php echo $ni.'/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
    </ul>
</div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Project.php');

$pro = new Project();
//$id=$_SESSION['user_id'];
$id= 1 ;
$user = $pro->getUserInfo($id);
?>



<!--Invento--><div class="wrapper-pad">
    <h2>Account Settings</h2>
    <div class="center">
        <div class="form" name="Settings" data-id="<?php echo $id; ?>">
            <form method="post" action="" name="account-settings" data-id="<?php echo $id; ?>" >
                Name:<br>
                <div class="ni-cont">
                    <input name="name" class="ni" value="<?php echo $user['name'];?>" type="text">
                </div>

                Email:<br>
                <div class="ni-cont">
                    <input name="email" class="ni" value="<?php echo $user['email'];?>" type="text">
                </div>
                <br>
                <input name="invento-settings-savesettings" class="ni btn blue" value="Save Settings" type="submit">
            </form>
        </div>
        <div>

            <h2 class="noborder">Change Password</h2>
            <span class="downtitle">If you don't want to change your password, leave the following boxes empty.</span>
            <div class="center">
                <div class="form">
                    <form method="post" action="" name="change-password" data-id="<?php echo $id; ?>" >
                        New Password:<br>
                        <div class="ni-cont">
                            <input name="new-password" class="ni" type="password">
                        </div>

                        Repeat New Password:<br>
                        <div class="ni-cont">
                            <input name="rnew-password" class="ni" type="password">
                        </div>
                        <br>
                        <input name="invento-settings-changepass" class="ni btn blue" value="Reset Password" type="submit">
                    </form>
                </div>
            </div>

            <h2>Invento Settings</h2>
            <div class="center">
                <div class="form">
                    <form method="post" action="" name="invento-settings" data-id="<?php echo $id; ?>" >
                        <div class="checkbox"><input name="allow-namechange" value="y" checked="" type="checkbox">Allow users to change their name<br></div>
                        <div class="checkbox"><input name="allow-emailchange" value="y" checked="" type="checkbox">Allow users to change their email<br></div>
                        <br>
                        <input name="invento-settings-save" class="ni btn blue" value="Save Settings" type="submit">
                    </form>
                </div>
            </div>
        </div>

        <div class="clear" style="margin-bottom:40px;"></div>
    </div>
</div>


<!--Invento-->

<?php
include_once ($ni . '/inc/footer.php');
?>


</body>
</html>