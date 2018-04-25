<?php

class BlogLike extends DB_object
{

    protected static $db_table = "blog_like";
    protected static $db_table_field = array('blog_like', 'blog_post_id', 'blog_user_id');

    public $id;
    public $blog_like;
    public $blog_post_id;
    public $blog_user_id;

    public static function get_all_likes($blogId)
    {
        global $database;
        $query = "SELECT * FROM blog_like WHERE blog_post_id = '{$blogId}'";
        return $database->query($query);
    }

}