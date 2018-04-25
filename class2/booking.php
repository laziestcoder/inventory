<?php

class Booking extends DB_object
{
    protected static $db_table = "tbl_book";
    protected static $db_table_field = array('user_email', 'room_type', 'number_of_room', 'number_of_persons', 'code', 'hotel_id', 'pending_info', 'confirm_booking');

    public $id;
    public $user_email;
    public $room_type;
    public $number_of_room;
    public $number_of_persons;
    public $code;
    public $hotel_id;
    public $pending_info;
    public $confirm_booking;

    public static function get_unique_number()
    {
        $unique_id = '';
        for ($i = 1; $i <= 6; $i++) {
            $unique_id .= rand(0, 9);
        }
        return $unique_id;
    }

    public static function get_clients()
    {
        global $database;
        $query = "SELECT tbl_book.id, user_email, room_type, number_of_room, number_of_persons, tbl_registered_hotel.hotel_name, code from tbl_book INNER JOIN tbl_registered_hotel
                  ON tbl_book.hotel_id = tbl_registered_hotel.id WHERE tbl_book.pending_info = '0' AND confirm_booking = '0'";
        return $database->query($query);
    }

    public static function get_confirmed_clients()
    {
        global $database;
        $query = "SELECT tbl_book.id, user_email, room_type, number_of_room, number_of_persons, tbl_registered_hotel.hotel_name, code from tbl_book INNER JOIN tbl_registered_hotel
                  ON tbl_book.hotel_id = tbl_registered_hotel.id WHERE tbl_book.pending_info = '1' AND confirm_booking = '0'";
        return $database->query($query);
    }
}

?>