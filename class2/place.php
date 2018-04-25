<?php

class Place extends DB_object
{
    protected static $db_table = "tbl_place";
    protected static $db_table_field = array('place_name', 'place_description', 'city_id', 'place_image');

    public $id;
    public $place_name;
    public $place_description;
    public $city_id;
    public $place_image;

    public static function get_image($file)
    {
        $image = $file['name'];
        return $image;
    }

    public function image_path()
    {
        $location = '../images/places/';
        return $location . $this->place_image;
    }

    public static function all_places()
    {
        global $database;

        $query = "SELECT tbl_place.id, place_name, place_description, city_name, place_image FROM tbl_place";
        $query .= " INNER JOIN tbl_city ";
        $query .= "ON tbl_place.city_id = tbl_city.id ORDER BY tbl_place.id";

        return $database->query($query);
    }

    public static function find_places($post_query)
    {
        global $database;

        $query = "SELECT * FROM tbl_place WHERE place_name LIKE '%" . $post_query . "%'";
        $result = $database->query($query);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                /*$output .= '<li>' . $row['place_name'] . '</li>';
                $output .= '<li onclick="selectCountry(' . $row['place_name'] . ')">' . $row['place_name'] . '</li>';*/
                $data[] = $row['place_name'];
            }
        }

        return json_encode($data);
    }

    public static function count_place()
    {
        global $database;
        $query = "SELECT * FROM tbl_place";
        $result = $database->query($query);
        $count_result = mysqli_num_rows($result);
        return $count_result;
    }
}

?>