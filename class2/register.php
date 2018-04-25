<?php

class Register extends DB_object
{
    protected static $db_table = "tbl_user";
    protected static $db_table_field = array('username', 'email', 'password','hash','active');


    public $id;
    public $username;
    public $email;
    public $password;
    public $hash;
    public $active;

}

?>
