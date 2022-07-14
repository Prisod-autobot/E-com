<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'localhost');
define('DB_PASS', '');
define('DB_NAME', 'tree');

class DB_con
{
    public function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbcon = $conn;

        if (mysqli_connect_errno()) {
            echo "Error connecting to" . mysqli_connect_error();
        }
    }
    public function usernameavailable($username)
    {
        $checkuser = mysqli_query($this->dbcon, "SELECT username FROM users_oop WHERE username = '$username'");
        return $checkuser;
    }

    public function emailavailable($useremail)
    {
        $checkemail = mysqli_query($this->dbcon, "SELECT useremail FROM users_oop WHERE useremail = '$useremail'");
        return $checkemail;
    }

    public function registration($username, $fullname, $useremail, $password)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO users_oop(username,fullname,useremail,password)
            VALUE('$username','$fullname', '$useremail', '$password')");
        return $reg;
    }

    public function signin($username, $password)
    {
        setcookie('nom', '1', time() + 86400, '/');
        $signinquery = mysqli_query($this->dbcon, "SELECT id, fullname, ulevel FROM users_oop WHERE username = '$username' AND password = '$password'");
        return $signinquery;
    }
    public function checkStatus($username, $activeStatus)
    {
        $status = mysqli_query($this->dbcon, "UPDATE users_oop SET active = '$activeStatus' WHERE username = '$username'");
        return $status;
    }
    public function notActive($numberUser, $activeStatus)
    {
        $status = mysqli_query($this->dbcon, "UPDATE users_oop SET active = '$activeStatus' WHERE id = '$numberUser'");
        return $status;
    }
}