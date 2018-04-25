<?php

class DB_object
{
    public static function find_all()
    {
        $query = "SELECT * FROM " . static::$db_table;
        return static::find_by_query($query);
    }

    public static function find_by_id($id)
    {
        $query = "SELECT * FROM " . static::$db_table . " WHERE id = $id";
        $the_result_array = static::find_by_query($query);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function get_city_info($city_name)
    {
        $query = "SELECT * FROM " . static::$db_table . " WHERE city_name = '{$city_name}'";
        $the_result_array = static::find_by_query($query);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        //print_r($result_set);
        //print_r( mysqli_fetch_assoc($result_set));
        //var_dump( mysqli_fetch_assoc($result_set));
        if($result_set) {
            while ($row = mysqli_fetch_assoc($result_set)) {
                $the_object_array[] = static::instantiation($row);
            }
        }
        //print_r($sql);
        //print_r($row);

        return $the_object_array;
    }

    public static function instantiation($the_record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    //dynamically created property
    protected function properties()
    {
        $properties = array();
        foreach (static::$db_table_field as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    //dynamically cleaning properties
    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //dynamically create method(also can use another class)
    public function create()
    {
        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

        // print_r($sql);

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    //dynamically create update method(also can use another class)
    public function update()
    {
        global $database;

        $properties = $this->clean_properties();
        $property_pairs = array();

        foreach ($properties as $key => $value) {
            $property_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $property_pairs);
        $sql .= " WHERE id = {$this->id}";

        //print_r($sql);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete()
    {
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " WHERE id = {$database->escape_string($this->id)} LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public static function set_image($file)
    {
        $image = basename($file['name']);
        $image_temp = $file['tmp_name'];
        $explode = explode('.', $image);
        $extension = end($explode);
        //print_r($extension);
        $name = substr(md5(time()), 0, 10) . '.' . $extension;
        //print_r($name);
        $location = '../images/';

        move_uploaded_file($image_temp, $location . $name);

        return $name;
    }
}

$db_object = new DB_object();

?>