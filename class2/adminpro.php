<?php
//require_once("init.php");
class Adminpro extends DB_object
{
    protected static $db_table = "tbl_admin";
    protected static $db_table_field = array('fullname','admin_name', 'occupation','gender', 'admin_password', 'admin_email','mobileno','nationality','address','bio','admin_category','hash','active','admin_image','cov_image');


    public $id;
    public $fullname;
    public $admin_name;
    public $occupation;
    public $gender;
    public $admin_password;
    public $admin_email;
    public $mobileno;
    public $nationality;
    public $address;
    public $bio;
    public $admin_category;
    public $hash;
    public $active;
    public $admin_image;
    public $cov_image;


    public static function set_pimage($file)
    {
        $image = basename($file['name']);
        $image_temp = $file['tmp_name'];
        //print_r($image_temp);
        $explode = explode('.', $image);
        $extension = end($explode);
        //print_r($extension);
        $name = substr(md5(time()), 0, 10) . '.' . $extension;
        //print_r($name);
        $location = 'images/admins/';

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
        $location = 'images/admincov/';

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
        $location = 'images/admins/';
        return $location . $this->admin_image;
    }
    public function covimage_path()
    {
        $location = 'images/admincov/';
        return $location . $this->cov_image;
    }
}

?>