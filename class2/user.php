<?php

class User extends DB_object
{
    protected static $db_table = "tbl_user";
    protected static $db_table_field = array('username', 'email', 'password','mobile_no','address','hash','active');


    public $userid;
    public $name;
    public $username;
    public $password;
    public $email;
    public $role;
    public $membersince;
    public $hash;

    public static function verify_user($username, $password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ( username = '{$username}' OR email = '{$username}' ) AND password = '{$password}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        //returen var_dump(array_shift($the_result_array));
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function find_user($username)
    {
        global $database;

        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' OR email ='{$username}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function recover_pass($username)
    {
        global $database;

        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' OR email = '{$username}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        return !empty($the_result_array) ? $database->query($sql) : false;
    }
    public static function user_active($username,$password){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE (username = '{$username}' OR email = '{$username}') AND password='{$password}' AND active = '1' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? $database->query($sql) : false;

    }


} //end of user class

?>