<?php

class Division extends DB_object
{
    protected static $db_table = "tbl_division";
    protected static $db_table_field = array('div_name', 'div_description', 'div_image');

    public $id;
    public $div_name;
    public $div_description;
    public $div_image;

    public static function get_image($file)
    {
        $image = $file['name'];
        return $image;
    }

    public function image_path()
    {
        $location = '../images/';
        return $location . $this->div_image;
    }

    public static function count_divisions()
    {
        global $database;
        $query = "SELECT * FROM tbl_division";
        $result = $database->query($query);
        $count_result = mysqli_num_rows($result);
        return $count_result;
    }
}

?>