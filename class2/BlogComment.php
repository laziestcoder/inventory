<?php

class BlogComment extends DB_object
{
    protected static $db_table = "blog_comment";
    protected static $db_table_field = array('blog_comment', 'blog_post_id', 'blog_user_id');

    public $id;
    public $blog_comment;
    public $blog_post_id;
    public $blog_user_id;

    public static function get_all_comments($blogId)
    {
        global $database;
        $query = "SELECT * FROM blog_comment WHERE blog_post_id = '{$blogId}' ORDER BY `id` DESC";
        //print_r($query);
        return $database->query($query);
    }
    public static function comment_count($blogId)
    {
        global $database;
        //$query = "SELECT COUNT(blog_comment) as blog_number FROM blog_comment WHERE blog_post_id = '{$blogId}'";
        $query = "SELECT * FROM blog_comment WHERE blog_post_id = '{$blogId}'";
        //print_r($query);
        $result = $database->query($query);
        $row = mysqli_num_rows($result);
        return $row;
    }


}