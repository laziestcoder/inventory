<?php
include_once('../inc/address.php');
$ni = $add;
include_once($ni.'/inc/header.php');

?>
<script src="js/jquery.js"></script>
<!--<script src="js/main.js"></script>-->
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
        <li><a href="<?php echo $ni . '/category'; ?>" title="Categories"><i class="fa fa-folder"></i> Categories</a>
        </li>
    </ul>
</div>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Project.php');

$pro = new Project();
$id = $_GET['userid'];
$check = $pro->getUserInfo($id);
$roleid = $check['role'];
//$roleid= 3;
$role = $pro->getRoleInfo($roleid);
$roleList = $pro->Role();
?>


<!--Invento-->
<div class="wrapper-pad">
    <h2>Edit User</h2>
    <div class="center">
        <div class="new-item form">
            <form method="post" action="" name="edit-user" data-id="<?php echo $id ?>">
                Name:<br>
                <div class="ni-cont">
                    <input name="euser-name" class="ni" value="<?php echo $check['name'] ?>" type="text">
                </div>
                Email:<br>
                <div class="ni-cont">
                    <input name="euser-email" class="ni" value="<?php echo $check['email'] ?>" type="text">
                </div>
                Role: ( <?php echo $role['rolename'] ?> )<br>
                <div class="select-holder">

                    <select data-id="<?php echo $roleid; ?>" name="euser-role"><i class="fa fa-caret-down"></i>
                        <?php
                        if ($roleList) {
                            //print_r($roleList->fetch_assoc());
                            while ($roleL = $roleList->fetch_assoc()) {
                                echo "<option name='role'" . $roleL['id'] . " value='" . $roleL['id'] . "'>" . $roleL['rolename'] . "</option>";

                            }
                        }
                        ?>
                    </select>
                </div>
                <input name="euser-submit" class="ni btn blue" value="Edit user" type="submit">
            </form>
        </div>
    </div>
</div>
<div id="pagination">
    <div class="page">1</div>
    <br><br>
</div>
<div class="clear" style="margin-bottom:40px;"></div>


<!--Invento-->

<?php
include_once($ni . '/inc/footer.php');
?>


</body>
</html>