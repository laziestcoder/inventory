<?php

class RegisterHotel extends DB_object
{
    protected static $db_table = "tbl_registered_hotel";
    protected static $db_table_field = array('hotel_name', 'hotel_admin_name', 'phone_number', 'hotel_email', 'password', 'hotel_location', 'hotel_description', 'city_id', 'hotel_image', 'pending_info');

    public $id;
    public $hotel_name;
    public $hotel_admin_name;
    public $phone_number;
    public $hotel_email;
    public $password;
    public $hotel_location;
    public $hotel_description;
    public $city_id;
    public $hotel_image;
    public $pending_info;


    // public $random_number;

    /*public static function get_unique_number()
    {
        $unique_id = '';
        for ($i = 1; $i <= 6; $i++) {
            $unique_id .= rand(0, 9);
        }
        return $unique_id;
    }*/

    public static function set_image($file)
    {
        $image = basename($file['name']);
        $image_temp = $file['tmp_name'];
        //print_r($image_temp);
        $explode = explode('.', $image);
        $extension = end($explode);
        //print_r($extension);
        $name = substr(md5(time()), 0, 10) . '.' . $extension;
        //print_r($name);
        $location = '../images/';

        move_uploaded_file($image_temp, $location . $name);

        return $name;
    }

    public static function get_unregistered_hotel()
    {
        global $database;
        $query = "SELECT tbl_registered_hotel.id, hotel_name, hotel_admin_name, phone_number, hotel_email,";
        $query .= " tbl_city.city_name, hotel_location, hotel_description, hotel_image";
        $query .= " FROM tbl_registered_hotel INNER JOIN tbl_city ON tbl_registered_hotel.city_id = tbl_city.id WHERE pending_info = 0";
        return $database->query($query);
    }

    public static function get_registered_hotel()
    {
        global $database;
        $query = "SELECT tbl_registered_hotel.id, hotel_name, hotel_admin_name, phone_number, hotel_email,";
        $query .= " tbl_city.city_name, hotel_location, hotel_description, hotel_image";
        $query .= " FROM tbl_registered_hotel INNER JOIN tbl_city ON tbl_registered_hotel.city_id = tbl_city.id WHERE pending_info = 1";
        return $database->query($query);
    }

    public static function verify_hotel_admin($username, $password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ( hotel_admin_name = '{$username}' OR hotel_email = '{$username}' ) AND password = '{$password}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        //returen var_dump(array_shift($the_result_array));
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_hotel_admin($username)
    {
        global $database;

        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE hotel_admin_name = '{$username}' OR hotel_email ='{$username}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function hotel_recover_pass($username)
    {
        global $database;

        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE hotel_admin_name = '{$username}' OR hotel_email = '{$username}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        // return var_dump($the_result_array);
        return !empty($the_result_array) ? $database->query($sql) : false;
    }

    public static function hotel_admin_active($username, $password)
    {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE (hotel_admin_name = '{$username}' OR hotel_email = '{$username}') AND password='{$password}' AND pending_info = '1' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? $database->query($sql) : false;
    }

    public static function count_unregisteredHotel()
    {
        global $database;
        $query = "SELECT * FROM tbl_registered_hotel WHERE pending_info = '0'";
        $result = $database->query($query);
        $count_result = mysqli_num_rows($result);
        return $count_result;
    }

    public static function count_registerHotel()
    {
        global $database;
        $query = "SELECT * FROM tbl_registered_hotel WHERE pending_info = '1'";
        $result = $database->query($query);
        $count_result = mysqli_num_rows($result);
        return $count_result;
    }
}

?>