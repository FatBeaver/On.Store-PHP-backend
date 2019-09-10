<?php 

class Auth 
{
    public static function registration($f_name, $l_name, $email, $password)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO user (first_name, last_name, email, password)
                VALUES (:first, :last, :email, :password)";

        $result = $db->prepare($sql);
        $result->bindParam(':first', $f_name, PDO::PARAM_STR);
        $result->bindParam(':last', $l_name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        return $db->lastInsertId();
    }


    public static function isGuest()
    {
        return !isset($_SESSION['user_id']) ? true : false;
    }


    public static function CookieAuth()
    {
        if (isset($_COOKIE['user_id'])) {
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            $_SESSION['first_name'] = $_COOKIE['first_name'];
            $_SESSION['last_name'] = $_COOKIE['last_name'];
            $_SESSION['email'] = $_COOKIE['email'];
        }
    }


    public static function userLogin($email, $password)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1";

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $userData = $result->fetch();
        if (!empty($userData)) {
            return $userData;
        }
        return false;
    }   

    public static function logOut()
    {   
        setcookie('user_id', '', time() - 3600, '/');
        setcookie('first_name', '', time() - 3600, '/');
        setcookie('last_name', '', time() - 3600, '/');
        setcookie('email', '', time() - 3600, '/');
        setcookie(session_name(), session_id(), time()-60*60*60*24);
        session_destroy();
    }
}