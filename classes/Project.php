<?php
$filepath = realpath(dirname(__FILE__));
include_once('Database.php');

class Project
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        //echo "connected ";
    }


    //new category add

    public function newCategory($name, $place, $description)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $place = mysqli_real_escape_string($this->db->link, $place);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $query = "INSERT INTO category(name,place,description) VALUES('$name','$place','$description')";
        $getuser = $this->db->insert($query);
        //var_dump($getuser);
        if ($getuser) {
            //echo "success";
            return true;
        } else {
            //echo "failed";
            return false;
        }
    }

    //All Category
    public function Category()
    {
        $query = "SELECT * FROM category ORDER BY id DESC";//DESC or nothing
        $getContent = $this->db->select($query);
        return $getContent;
    }

    //show category data
    public function getCategoryData()
    {
        $getContent = $this->Category();
        /*<td width="5%"><input name="select-all" type="checkbox"></td>*/
        $result ='<table id="categories" rules="rows" border="1" class="table table-hover"><thead>
                    <tr>						
						<td width="6%">ID</td>
						<td width="28%">Category Name</td>
						<td width="19%">Place</td>
						<td width="14%">Registered Items</td>
						<td width="17%">Total Items</td>
						<td width="11%">Actions</td>
					</tr></thead>';
        if ($getContent) {
            while ($data = $getContent->fetch_assoc()) {
                $id = $data['id'];
                $name = $data['name'];
                $place = $data['place'];
                $registeredItems = $data['registereditems'];
                $totalItems = $data['totalitems'];
                $result .= '<tr>
                            <td>' . $id . '</td><td>' . $name . '</td><td>' . $place . '</td>
                            <td>' . $registeredItems . '</td><td>' . $totalItems . '</td>
                            <td><a href="edit-category.php?id=' . $id . '" name="c3" title="Edit Item">
                            <i class="fa fa-pencil"></i></a>
                            <a href="../log/index.php?catid=' . $id . '" name="c4" title="Log of this category">
                            <i class="fa fa-file-text-o"></i></a><a href="" name="c5" title="Delete Item">
                            <i class="fa fa-close"></i></a></td></tr>';
            }
        } else {
            $result .= 'No Result Found!';
        }
        $result .= '</table>';
        echo $result;
        //exit();
    }

    //get category info
    public function getCategoryInfo($id)
    {
        $id = "SELECT * FROM category WHERE id='$id'";
        $id = $this->db->select($id);
        if ($id) {
            return $id->fetch_assoc();
        } else {
            return false;
        }
    }

    //Category Update

    public function updateCategoryInfo($id, $name, $desc, $place)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $desc = mysqli_real_escape_string($this->db->link, $desc);
        $place = mysqli_real_escape_string($this->db->link, $place);
        $query = "UPDATE category SET name = '$name', description ='$desc', place ='$place' WHERE id = '$id'";
        $query = $this->db->update($query);
        if ($query) {
            return "1";
        } else {
            return "0";
        }
    }


    //add new item
    public function newItem($name, $category, $description, $quantity, $price)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $category = mysqli_real_escape_string($this->db->link, $category);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $date = date("Y-m-d");
        $query = "INSERT INTO items(name,description,category,quantity,price,date) VALUES('$name','$description','$category','$quantity','$price','$date')";
        $result = $this->db->insert($query);
        if ($result) {
            //$user=$_SESSION['user_id'];
            //$user = 1;
            // $id = $this->db->link->insert_id;
            //$val = $quantity;
            //$prev = 0;
            //$chk = 1;
            //$this->logUpdate($id, $chk, $prev, $val, $user);
            return true;
            //echo "success";
        } else {
            //echo "failed";
            return false;
        }


    }


    //show item data
    public function getItemData()
    {
        $query = "SELECT * FROM items ORDER BY id DESC";//DESC or nothing
        $getContent = $this->db->select($query);
        //<td width="5%"><input type="checkbox" name="select-all" /></td>
        $result = '<table border="1" rules="rows" id="items" class="table table-hover">
            <thead >
            <tr>
                
                <td width="6%">ID</td>
                <td width="30%">Item</td>
                <td width="20%">Category</td>
                <td width="10%">QTY</td>
                <td width="14%">Price each</td>
                <td width="15%">Actions</td>
            </tr>
            </thead>
            <tbody>';
        if ($getContent) {
            while ($data = $getContent->fetch_assoc()) {
                $id = $data['id'];
                $name = $data['name'];
                //$description=$data['description'];
                $category = $data['category'];
                $category = $this->getCategoryInfo($category);
                $category = $category['name'];
                $quantity = $data['quantity'];
                $price = $data['price'];
                //<td><input type="checkbox" name="chbox" value="' . $id . '"  /></td>
                $result .= '<tr data-type="element" data-id="' . $id . '">						
						<td class="hover" data-type="id">' . $id . '</td>
						<td class="hover" data-type="name">' . $name . '</td>
						<td class="hover" data-type="cat">' . $category . '</td>
						<td>' . $quantity . '</td>
						<td>' . $price . '</td>
						<td>
							<a href="edit-item.php?id=' . $id . '" name="c3" title="Edit Item"><i class="fa fa-pencil"></i></a>
							<a href="../log/index.php?itemid=' . $id . '" name="c4" title="Log"><i class="fa fa-file-text-o"></i></a>
							<a href="" name="c5" title="Delete Item"><i class="fa fa-close"></i></a></td></tr>';
            }
        } else {
            $result = 'No Result Found!';
        }
        $result .= '</tbody></table>';
        echo $result;
        //exit();
    }

    // get item info
    public function getItemInfo($id)
    {
        $query = "SELECT * FROM items WHERE id='$id' ";//DESC or nothing
        $getContent = $this->db->select($query);
        if ($getContent) {
            return $getContent->fetch_assoc();
        } else {
            return false;
        }
    }


    //show check in or check out data
    public function checkInItem()
    {
        $query = "SELECT * FROM items ORDER BY id DESC";//DESC or nothing
        $getContent = $this->db->select($query);
        $result = '<table rules="rows" class="table table-hover" id="items-check" border="1">
        <thead>
        <tr>
            <td width="7%">ID</td>
            <td width="40%">Item</td>
            <td width="20%">Category</td>
            <td width="18%">QTY</td>
            <td width="15%">Price each</td>
        </tr>
        </thead><tbody>';
        while ($data = $getContent->fetch_assoc()) {
            $id = $data['id'];
            $name = $data['name'];
            $category = $data['category'];
            $category = $this->getCategoryInfo($category);
            $category = $category['name'];
            $quantity = $data['quantity'];
            $price = $data['price'];
            $result .= '<tr data-id="' . $id . '">
                        <td>' . $id . '</td><td>' . $name . '</td><td>' . $category . '</td>
                        <td data-toggle="collapse" data-target="#dataId' . $id . '" >' . $quantity . '</td><td>' . $price . '</td></tr>';

            $result .= '<tr id="dataId' . $id . '" class="collapse" style="" data-id="">
                        <td></td><td></td><td></td><td>
                        <form data-saveid="' . $id . '" action="" method="post" name="check-in">
                        <input id="checkInValue" class="num" placeholder="# of items" type="text"></form></td><td>
                        <input href="" id="submit' . $id . '" type="submit" class="btn blue save check-in"
                        value="Save" name="submit">
                        </td><td></td></tr>';
        }
        if ($getContent) {
        } else {
            $result .= 'No Result Found!';
        }
        $result .= '</tbody></table>';
        echo $result;

        //exit();
    }

    // Item Info Update

    public function updateItemInfo($id, $name, $desc, $cat, $price)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $desc = mysqli_real_escape_string($this->db->link, $desc);
        $cat = mysqli_real_escape_string($this->db->link, $cat);
        $query = "UPDATE items SET name = '$name', description ='$desc', category ='$cat', price='$price' WHERE id = '$id'";
        $query = $this->db->update($query);
        if ($query) {
            echo "1";
        } else {
            echo "0";
        }
    }

    //check in and check out data
    public function updateItem($val, $prev, $id, $chk)
    {

        $query = "UPDATE items SET quantity = '$val', prevquantity ='$prev' WHERE id = '$id'";
        $query = $this->db->update($query);
        //print_r("this is ".$query);
        //exit();
        if ($query) {
            echo "1";
        } else {
            echo "0";
        }
        //$user=$_SESSION['user_id'];
        $money = $this->getItemInfo($id);
        $money = $money['price'];
        $user = 1;
        $this->logUpdate($id, $chk, $prev, $val, $money, $user);
    }


    // check login username and password
    public function checkLogin($user, $password)
    {
        $user = mysqli_real_escape_string($this->db->link, $user);
        $password = mysqli_real_escape_string($this->db->link, $password);
        //echo "Class=>email=".$email.". Password=".$password.".<br>";
        $query = "SELECT * FROM user WHERE username = '$user' AND password='$password'";
        $getuser = $this->db->select($query);
        if (!$getuser) {
            echo 1;
        } else if ($getuser) {
            echo 3;
        } else {
            echo 2;
        }
        //print_r($getuser);
        exit();
    }

    //Log Data Entry
    public function logUpdate($itemid, $checktype, $from, $to, $money, $user)
    {
        $money = $money * abs($from - $to);
        $date = date("Y-m-d");
        $query = "INSERT INTO logs(itemid,checktype,previousno,presentno,money,userid,date) VALUES('$itemid','$checktype','$from','$to','$money','$user','$date')";
        $result = $this->db->insert($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //show log data
    public function getLogData()
    {
        $query = "SELECT * FROM logs ORDER BY logid DESC";//DESC or nothing
        $getContent = $this->db->select($query);
        $result = '<table id="logs" rules="rows" border="1" class="table table-hover"><thead>
                    <tr><th scope="col">ID</th><th scope="col">Type</th><th scope="col">Item</th>
                    <th scope="col">From</th><th scope="col">To</th><th scope="col">User</th>
                    <th scope="col">Date</th></tr></thead>';
        if ($getContent) {
            while ($data = $getContent->fetch_assoc()) {
                $lid = $data['logid'];
                $id = $data['itemid'];
                $checktype = $data['checktype'];
                if ($checktype == 1) {
                    $check = "Check In";
                } else {
                    $check = "Check Out";
                }
                $name = $this->getItemInfo($id);
                $name = $name['name'];
                $from = $data['previousno'];
                $to = $data['presentno'];
                $user = $data['userid'];
                $user = $this->getUserInfo($user);
                $user = $user['name'];
                $date = $data['date'];
                $result .= '<tbody data-id="' . $lid . '"><td>' . $lid . '</td>
                            <td>' . $check . '</td><td>' . $name . '</td>
                            <td>' . $from . '</td><td>' . $to . '</td>
                            <td>' . $user . '</td>
                            <td>' . $date . '</td>
                            </tr></tbody>';
            }
        } else {
            $result .= 'No Result Found!';
        }
        $result .= '</table>';
        echo $result;
        //exit();

    }


    //add new user
    public function newUser($name, $username, $password, $email, $role)
    {
        $checkUser = $this->checkUserName($username);
        $checkEmail = $this->checkUserName($email);
        if ($checkUser == 3) {
            return 1;
        }
        if ($checkEmail == 3) {
            return 2;
        }
        $name = mysqli_real_escape_string($this->db->link, $name);
        $date = date("Y-m-d");
        $date = mysqli_real_escape_string($this->db->link, $date);
        $email = mysqli_real_escape_string($this->db->link, $email);
        //echo $date;
        $query = "INSERT INTO `user`(`name`, `username`, `password`, `email`, `role`, membersince, `active`) VALUES ('$name','$username','$password','$email','$role','$date','0')";
        $query = $this->db->insert($query);
        if ($query) {
            return 3;
        } else {
            return 4;
        }
    }

    //check user name existence
    public function checkUserName($username)
    {
        $query = "SELECT * FROM user WHERE username = '$username'";
        $getuser = $this->db->select($query);

        if ($username == "") {
            return 1;
        } elseif (!$getuser) {
            return 2;
        } else {
            return 3;
        }
    }


    //check email id existence
    public function checkEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $getuser = $this->db->select($query);

        if ($email == "") {
            return 1;
        } elseif (!$getuser) {
            return 2;
        } else {
            return 3;
        }
    }


    // Show user Data
    public function getUserData()
    {
        $query = "SELECT * FROM user ORDER BY userid DESC";//DESC or nothing
        $getContent = $this->db->select($query);
        //echo $getContent;
        $result = '<table rules="rows" id="users" border="1">
        <thead>
        <tr>
            <td width="5%">ID</td>
            <td width="18%">Name</td>
            <td width="17%">Username</td>
            <td width="22%">Email</td>
            <td width="15%">Role</td>
            <td width="14%">Member since</td>
            <td width="9%">Actions</td>
        </tr>
        </thead>
        <tbody>';
        if ($getContent) {
            $sl = 1;
            while ($data = $getContent->fetch_assoc()) {
                $id = $data['userid'];
                $name = $data['name'];
                //$description=$data['description'];
                $role = $data['role'];
                $role = $this->getRoleInfo($role);
                $role = $role['rolename'];
                $username = $data['username'];
                $email = $data['email'];
                $date = $data['membersince'];

                $result .= '<tr data-type="element" data-id="' . $id . '">
            <td class="hover" data-type="id">' . $sl . '</td>
            <td class="hover" data-type="name">' . $name . '</td>
            <td class="hover" data-type="username">' . $username . '</td>
            <td class="hover" data-type="email">' . $email . '</td>
            <td class="hover" data-type="role">' . $role . '</td>
            <td class="hover" data-type="date">' . $date . '</td>
            <td>
                <a href="edit-user.php?userid=' . $id . '" name="c3" title="Edit User">
                <i class="fa fa-pencil"></i></a><a href="../log/index.php?userid=4" name="c4" title="Log of this user">
                <i class="fa fa-file-text-o"></i></a>
                <a href="" name="c5" title="Delete User"><i class="fa fa-close"></i></a></td>
        </tr>';
                $sl = $sl + 1;
            }
        } else {
            $result = 'No Result Found!';
        }
        $result .= '</tbody></table>';
        echo $result;
        //exit();

    }


    //get user info
    public function getUserInfo($id)
    {
        $query = "SELECT * FROM user WHERE userid='$id' ";//DESC or nothing
        $getContent = $this->db->select($query);
        return $getContent->fetch_assoc();
    }

    //Update User Info
    public function updateUser($name, $email, $role, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $role = mysqli_real_escape_string($this->db->link, $role);
        $query = "UPDATE `user` SET `name` = '$name', `email` = '$email', `role` = '$role' WHERE `userid` = '$id'";
        $updateData = $this->db->update($query);
        //echo "EDIT WORKED";
        if ($updateData) {
            return 1;
        } else {
            return 2;
        }
    }

    public function updateEmailName($name, $email, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $query = "UPDATE `user` SET `name` = '$name', `email` = '$email'WHERE `userid` = '$id'";
        $updateData = $this->db->update($query);
        //echo "EDIT WORKED";
        if ($updateData) {
            return 1;
        } else {
            return 2;
        }

    }

    public function updateUserPassword($password, $id)
    {
        $password = mysqli_real_escape_string($this->db->link, $password);
        $query = "UPDATE `user` SET `password` = '$password'WHERE `userid` = '$id'";
        $updateData = $this->db->update($query);
        //echo "EDIT WORKED";
        if ($updateData) {
            return 1;
        } else {
            return 2;
        }

    }


    //All Role

    public function Role()
    {
        $query = "SELECT * FROM role ORDER BY id";//DESC or nothing
        $getContent = $this->db->select($query);
        return $getContent;
    }

    // get role info
    public function getRoleInfo($id)
    {
        $query = "SELECT * FROM role WHERE id='$id' ";//DESC or nothing
        $getContent = $this->db->select($query);
        return $getContent->fetch_assoc();
    }

    // Home Stat Daily Weekly Monthly Yearly and All Time
    public function home($value)
    {
        $day = date("Y-m-d");
        $week = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 7, date("Y")));
        $month = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d"), date("Y")));
        $year = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 1));
        $alltime = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 100));
        //return print_r($day." ".$week." ".$month." ".$year);
        if ($value == 'today') {
            $today = $day;
        } else if ($value == 'this_week') {
            $today = $week;
        } else if ($value == 'this_month') {
            $today = $month;
        } else if ($value == 'this_year') {
            $today = $year;
        } else if ($value == 'all_time') {
            $today = $alltime;
        } else {
            return false;
        }
        $toDate = $today;
        $items = $this->countNewItem($day, $toDate);
        $checkInQty = $this->countCheckQuantity($day, $toDate, 1);
        $checkOutQty = $this->countCheckQuantity($day, $toDate, 0);
        $checkInMny = $this->countCheckMoney($day, $toDate, 1);
        $checkOutMny = $this->countCheckMoney($day, $toDate, 0);
        return $items . "|" . $checkInQty . "|" . $checkOutQty . "| $" . $checkInMny . "| $" . $checkOutMny;
    }

    //Home General Stat

    public function homeGeneral()
    {
        $items = "SELECT * FROM items";
        $items = $this->db->select($items);
        $items = mysqli_num_rows($items);

        $quantity = "SELECT SUM(quantity) AS totalResult FROM items";
        $quantity = $this->db->select($quantity);
        $quantity = $quantity->fetch_assoc();
        $quantity = $quantity['totalResult'];

        $value = "SELECT SUM(quantity * price) AS totalResult FROM items";
        $value = $this->db->select($value);
        $value = $value->fetch_assoc();
        $value = $value['totalResult'];

        $valueChecked = "SELECT SUM(money) AS totalResult FROM logs WHERE checktype='0'";
        $valueChecked = $this->db->select($valueChecked);
        $valueChecked = $valueChecked->fetch_assoc();
        $valueChecked = $valueChecked['totalResult'];
        return $items . "|" . $quantity . "| $" . $value . "| $" . $valueChecked;

    }

    //New Items
    public function countNewItem($day, $toDate)
    {
        $query = "SELECT * FROM items WHERE date <= '$day' AND date >= '$toDate' ";//DESC or nothing
        $getContent = $this->db->select($query);
        if ($getContent) {
            //$result = $getContent->fetch_assoc();
            return mysqli_num_rows($getContent);
        } else {
            return '0';
        }
    }

    //Check Items
    public function countCheckQuantity($day, $toDate, $chk)
    {
        $query = "SELECT SUM(abs(previousno-presentno)) AS totalResult FROM logs WHERE checktype='$chk' AND ( date <= '$day' AND date >= '$toDate' ) ";//DESC or nothing
        $getContent = $this->db->select($query);
        if ($getContent) {
            $result = $getContent->fetch_assoc();
            if ($result['totalResult'] > 0) {
                return $result['totalResult'];
            } else {
                return '0';
            }
        } else {
            return '0';
        }
    }

    // Checked Money
    public function countCheckMoney($day, $toDate, $chk)
    {
        //return "kicchu nai";

        $query = "SELECT SUM(money) AS totalResult FROM logs WHERE checktype='$chk' AND ( date <= '$day' AND date >= '$toDate' ) ";//DESC or nothing
        $getContent = $this->db->select($query);
        if ($getContent) {
            $result = $getContent->fetch_assoc();
            if ($result['totalResult'] > 0) {
                if ($result['totalResult'] > 0) {
                    return $result['totalResult'];
                } else {
                    return '0';
                }
            } else {
                return '0';
            }

        } else {
            return '0';
        }
    }

    /* inventory functions ends*/


    //autoComplete
    public function autoComplete($search, $db_tbl, $row_name)
    {
        $query = "SELECT * FROM $db_tbl WHERE $row_name LIKE '%$search%'";
        $getroute = $this->db->select($query);
        //print_r($getroute);
        //var_dump($getroute);
        $row = strtoupper($row_name);
        $result = '<div class="searchresult"><b>' . $row . '</b><ul>';
        if ($getroute) {
            while ($data = $getroute->fetch_assoc()) {
                $result .= '<li>' . $data[$row_name] . '</li>';
            }
        } else {
            $result .= 'No Result Found!';
        }
        $result .= '</ul></div>';
        echo $result;
        exit();
    }


    public function checkRouteInsert($value, $tblName, $rowName)
    {
        if ($value != '') {
            $query = "SELECT * FROM $tblName WHERE $rowName = '$value'";
            $getdata = $this->db->select($query);
            if (!$getdata) {
                $query = "INSERT INTO $tblName($rowName) VALUES('$value')";
                $getdata = $this->db->insert($query);
                if ($getdata) {
                    echo "<span class='success'>Data Inserted Successfully.</span>";
                } else {
                    echo "<span class='error'>Data Insertion Failed!</span>";
                }
            } else {
                echo "<span class='error'>Inputed Data Exist!</span>";
            }
        } else {
            echo "<span class='error'>Input Data First!</span>";
        }
    }

    public function checkPointInsert($value, $value2, $tblName, $rowName, $rowName2)
    {
        if ($value && $value2) {
            $value2 = "SELECT * FROM tbl_route WHERE route = '$value2'";
            $value2 = $this->db->select($value2);
            //print_r($value2);
            if ($value2) {
                $value2 = $value2->fetch_assoc();
                $value2 = $value2['routeid'];
                $query = "SELECT * FROM $tblName WHERE $rowName = '$value'";
                $query = $this->db->select($query);
                //var_dump($value2);
                if (!$query) {

                    $query = "INSERT INTO $tblName($rowName,$rowName2) VALUES('$value','$value2') ";
                    //print_r($query);
                    $getdata = $this->db->insert($query);
                    if ($getdata) {
                        echo "<span class='success'>Data Inserted Successfully.</span>";
                    } else {
                        echo "<span class='error'>Data Insertion Failed!</span>";
                    }
                } else {
                    echo "<span class='error'>Point Exist!</span>";

                }
            } else {
                echo "<span class='error'>Route Doesn't Exist!</span>";

            }
        } else {
            echo "<span class='error'>Input Data First!</span>";

        }
    }

    public function getValuedData($tblName, $rowName)
    {

        $query = "SELECT * FROM $tblName ORDER BY $rowName";//DESC or nothing
        $getContent = $this->db->select($query);
        $row = strtoupper($rowName);
        $result = '<div class="searchresult"><b>' . $row . '</b><ul>';
        if ($getContent) {
            while ($data = $getContent->fetch_assoc()) {
                $result .= '<li>' . $data[$rowName] . '</li>';
            }
        } else {
            $result .= 'No Result Found!';
        }
        $result .= '</ul></div>';
        echo $result;
        //exit();
    }

    public function checkSearch($data)
    {
        $query = "SELECT * FROM tbl_search WHERE username LIKE '%$data%'";
        $getSearch = $this->db->select($query);
        if ($getSearch) {
            $data = "<table rules='rows' border='1' class ='tblone'>
			<tr>
			<th>Username</th>
			<th>Name</th>
			<th>Student ID</th>
			</tr>";
            while ($result = $getSearch->fetch_assoc()) {
                $data .= "<tr>
				<td>" . $result['username'] . "</td>
				<td>" . $result['name'] . "</td>
				<td>" . $result['studentid'] . "</td>
				</tr>";

            }
            $data .= "</table>";
            echo $data;

        } else {
            echo "Data Not Found.";
        }

    }

    public function autoSave($content, $contentid)
    {
        if ($contentid) {
            $query = "UPDATE tbl_autosave SET content = '$content', status = 'saved' WHERE contentid = '$contentid'";
            $updateData = $this->db->update($query);

        } else {
            $query = "INSERT INTO tbl_autosave(content,status) VALUES('$content','draft')";
            $insertData = $this->db->insert($query);
            $lastId = $this->db->link->insert_id;
            echo $lastId;
            exit();
        }
    }


}

?>