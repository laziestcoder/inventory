<?php

class Admin extends DB_object
{
    protected static $db_table = "tbl_admin";
    protected static $db_table_field = array('fullname','admin_name', 'admin_password', 'admin_email','mobileno','admin_category','hash','active');


    public $id;
    public $fullname;
    public $admin_name;
    public $admin_password;
    public $admin_email;
    public $mobileno;
    public $admin_category;
    public $hash;
    public $active;

    public static function verify_admin($username, $password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ( admin_name = '{$username}' OR admin_email = '{$username}' ) AND admin_password = '{$password}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        //returen var_dump(array_shift($the_result_array));
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function find_admin($username)
    {
        global $database;

        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE admin_name = '{$username}' OR admin_email ='{$username}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function recover_pass($username)
    {
        global $database;

        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE admin_name = '{$username}' OR admin_email = '{$username}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        return !empty($the_result_array) ? $database->query($sql) : false;
    }
    public static function admin_active($username,$password){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE (admin_name = '{$username}' OR admin_email = '{$username}') AND admin_password='{$password}' AND active = '1' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? $database->query($sql) : false;

    }


} //end of user class

?>