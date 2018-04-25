<?php require_once("DB_Object.php"); ?>
<?php

class City extends DB_object
{
    protected static $db_table = "tbl_city";
    protected static $db_table_field = array('city_name', 'city_description', 'div_id', 'city_image');

    public $id;
    public $city_name;
    public $city_description;
    public $div_id;
    public $city_image;

    public static function get_image($file)
    {
        $image = $file['name'];
        return $image;
    }

    public function image_path()
    {
        $location = '../images/';
        return $location . $this->city_image;
    }

    public static function all_cities()
    {
        global $database;

        $query = "SELECT tbl_city.id, city_name, city_description, div_name, city_image FROM tbl_city";
        $query .= " INNER JOIN tbl_division ";
        $query .= "ON tbl_city.div_id = tbl_division.id ORDER BY tbl_city.id";

        return $database->query($query);
    }

    public static function find_cities($post_query)
    {
        global $database;

        $query = "SELECT * FROM tbl_city WHERE city_name LIKE '%" . $post_query . "%'";
        $result = $database->query($query);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                /*$output .= '<li>' . $row['place_name'] . '</li>';
                $output .= '<li onclick="selectCountry(' . $row['place_name'] . ')">' . $row['place_name'] . '</li>';*/
                $data[] = $row['city_name'];
            }
        }

        return json_encode($data);
    }

    public static function count_city()
    {
        global $database;
        $query = "SELECT * FROM tbl_city";
        $result = $database->query($query);
        $count_result = mysqli_num_rows($result);
        return $count_result;
    }
}

?>