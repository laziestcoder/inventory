<?php

class Plan extends DB_object
{
    protected static $db_table = "tbl_plan";
    protected static $db_table_field = array('from_city', 'destination_city', 'first_place', 'second_place', 'days', 'plan_description', 'stay');

    public $id;
    public $from_city;
    public $destination_city;
    public $first_place;
    public $second_place;
    public $days;
    public $plan_description;
    public $stay;

    public static function find_plan($destination_city, $stay)
    {
        global $database;
        $query = "SELECT * FROM tbl_plan WHERE destination_city = '{$destination_city}' AND stay = '{$stay}'";
        return $database->query($query);
    }

    public static function count_plan()
    {
        global $database;
        $query = "SELECT * FROM tbl_plan";
        $result = $database->query($query);
        $count_result = mysqli_num_rows($result);
        return $count_result;
    }
}

?>