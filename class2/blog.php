<?php

class Blog extends DB_object
{
    protected static $db_table = "tbl_blog";
    protected static $db_table_field = array('blog_title', 'blog_post', 'blog_image', 'user_id', 'status', 'blog_comment');

    public $id;
    public $blog_title;
    public $blog_post;
    public $blog_image;
    public $user_id;
    public $status;
    public $blog_comment;

    public static function get_image($file)
    {
        $image = $file['name'];
        return $image;
    }

    public function image_path()
    {
        $location = 'include/images/';
        return $location . $this->blog_image;
    }



    public static function multi_images($file){

/*        $j = 0;     // Variable for indexing uploaded image.
        $target_path = "includes/images/";     // Declaring Path for uploaded images.
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
// Loop to get individual element from the array
            $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path . substr(md5(time()), 0, 10) . "." . $ext[count($ext) - 1];// Set the target path with a new name of image.
            $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
            if (($_FILES['file']["size"][$i] < 10000000)     // Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
// If file moved to uploads folder.
                    echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                } else {     //  If File Was Not Moved.
                    echo $j. ').<span id="error">please try again!.</span><br/><br/>';
                }
            } else {     //   If File Size And File Type Was Incorrect.
                echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
            }
        }
        return basename($target_path);*/


        $images = "";
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $fileName = $_FILES['file']['name'][$i];
            $images .= $_FILES['file']['name'][$i];
            if ($i != count($_FILES['file']['name']) - 1)
                $images .= ", ";
            $source = $_FILES['file']['tmp_name'][$i];
            $destination = "includes/images/" . $fileName;
            if (!file_exists($destination))
                move_uploaded_file($source, $destination);
        }
        return $images;


    }

    public static function all_blog()
    {
        $query = "SELECT * FROM ".static::$db_table;
        $query .= " ORDER BY `id` DESC";
        return static::find_by_query($query);
    }


   public static function top_blog()
    {
        $query = "SELECT * FROM ".static::$db_table ;
        //$query .= " INNER JOIN tbl_user ";
        $query .= " ORDER BY `blog_comment` DESC";
        //print_r($query);

        return static::find_by_query($query);
    }


   /* public static function top_blog_like()
    {
        global $database;

        $query = "SELECT * FROM ".static::$db_table ;
        //$query = "SELECT * FROM " . static::$db_table . " WHERE id = $id";
        $query .= " INNER JOIN tbl_user ";
        $query .= "ON tbl_blog.user_id = tbl_user.id ORDER BY tbl_blog.id ASC";

        return $database->query($query);
    }*/


    /*public static function top_blog_comment()
    {
        global $database;

        $query = "SELECT * FROM ".static::$db_table ;
        //$query = "SELECT * FROM " . static::$db_table . " WHERE id = $id";
        $query .= " INNER JOIN tbl_user ";
        $query .= "ON tbl_blog.user_id = tbl_user.id ORDER BY tbl_blog.id ASC|DESC";

        return $database->query($query);
    }*/


}

?>