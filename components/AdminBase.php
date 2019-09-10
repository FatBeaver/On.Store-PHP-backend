<?php 

class AdminBase
{
    public static function checkAdmin()
    {
        $userID = User::checkLogged();

        $user = User::getUserById($userID);
        
        if ($user['status'] == 1) {
            return true;
        }
        
        die('Доступ запрещен');
    }
}