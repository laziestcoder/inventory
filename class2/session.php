<?php require_once("init.php"); ?>
<?php

class Session extends DB_object
{
    private $signed_in = false;
    private $admin_signed_in = false;
    public $user_id;
    public $admin_id;


    function __construct()
    {
        session_start();
        $this->check_the_login();
        $this->check_the_admin_login();
        $this->check_the_hotel_admin_login();
    }

    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function is_admin_signed_in()
    {
        return $this->admin_signed_in;
    }

    public function is_hotel_admin_signed_in()
    {
        return $this->hotel_admin_signed_in;
    }

    public function login($user)
    {
        if ($user) {
            //var_dump($user);
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
            //header("Location:index.php");
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
        //session_destroy();// added later
    }

    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
            //session_destroy(); //added later
        }
    }

    public function admin_login($user)
    {
        // added later
        if ($user) {
            //var_dump($user);
            $this->admin_id = $_SESSION['admin_id'] = $user->id;
            $this->admin_signed_in = true;
            //header("Location:index.php");
        }
    }

    public function admin_logout()
    {
        unset($_SESSION['admin_id']);
        unset($this->admin_id);
        $this->admin_signed_in = false;
        // session_destroy();// added later
    }

    private function check_the_admin_login()
    {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->admin_signed_in = true;
        } else {
            unset($this->admin_id);
            $this->admin_signed_in = false;
            //session_destroy(); //added later
        }
    }

    public function hotel_admin_login($user)
    {
       // added later
        if ($user) {
            //var_dump($user);
            $this->hotel_admin_id = $_SESSION['hotel_admin_id'] = $user->id;
            $this->hotel_admin_signed_in = true;
            //header("Location:index.php");
        }
    }

    public function hotel_admin_logout()
    {
        unset($_SESSION['hotel_admin_id']);
        unset($this->hotel_admin_id);
        $this->hotel_admin_signed_in = false;
        // session_destroy();// added later
    }

    private function check_the_hotel_admin_login()
    {
        if (isset($_SESSION['hotel_admin_id'])) {
            $this->hotel_admin_id = $_SESSION['hotel_admin_id'];
            $this->hotel_admin_signed_in = true;
        } else {
            unset($this->hotel_admin_id);
            $this->hotel_admin_signed_in = false;
            //session_destroy(); //added later
        }
    }
}

$session = new Session();

?>