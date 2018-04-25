<?php
require_once("init.php");

class Profile extends DB_object
{
    protected static $db_table = "tbl_user";
    protected static $db_table_field = array('fullname','occupation','gender','username', 'email', 'password','mobile_no','nationality','address','hash','active','user_image','cov_image','bio');


    public $id;
    public $fullname;
    public $occupation;
    public $gender;
    public $username;
    public $email;
    public $password;
    public $mobile_no;
    public $nationality;
    public $address;
    public $hash;
    public $active;
    public $user_image;
    public $cov_image;
    public $bio;

    public static function set_pimage($file)
    {
        $image = basename($file['name']);
        $image_temp = $file['tmp_name'];
        //print_r($image_temp);
        $explode = explode('.', $image);
        $extension = end($explode);
       // print_r($extension);
        $name = substr(md5(time()), 0, 10) . '.' . $extension;
        //print_r($name);
        $location = 'images/users/';
        //print_r($location);

        move_uploaded_file($image_temp, $location . $name);

        return $name;
    }
    public static function set_covimage($file)
    {
        $image = basename($file['name']);
        $image_temp = $file['tmp_name'];
        //print_r($image_temp);
        $explode = explode('.', $image);
        $extension = end($explode);
        //print_r($extension);
        $name = substr(md5(time()), 0, 10) . '.' . $extension;
        //print_r($name);
        $location = 'images/usercov/';

        move_uploaded_file($image_temp, $location . $name);

        return $name;
    }

    public static function get_image($file)
    {
        $image = $file['name'];
        return $image;
    }

    public function image_path()
    {
        $location = 'images/users/';
        return $location . $this->user_image;
    }
    public function covimage_path()
    {
        $location = 'images/usercov/';
        return $location . $this->cov_image;
    }
}

?>