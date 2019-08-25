<?php 

class User 
{
    public static function checkLogged()
    {
       return isset($_SESSION['user']) ? $_SESSION['user'] : header('Location: /user/login/'); 
    }

    public static function adminCreateUser($userData)
    {

    }

    public static function adminDeleteUser($userData)
    {

    }

    public static function adminUpdateUser($userData)
    {

    }

    public static function adminViewUsers()
    {
        
    }
}