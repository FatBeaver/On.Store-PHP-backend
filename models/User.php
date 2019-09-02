<?php 

class User 
{   
    // ============= START ADMIN ACTION ==========================
    public static function checkLogged()
    {
       return isset($_SESSION['user']) ? $_SESSION['user'] : header('Location: /user/login/'); 
    }

    public static function adminCreateUser($user)
    {
        $db = Db::getConnection();

        $sql = "INSERT INTO " 
                . "user "
                . "(first_name, last_name, password, email, "
                . "work_position, image, status) "
                . "VALUES "
                . "(:first_name, :last_name, :password, :email, "
                . ":work_position, :image, :status)";

        $result = $db->prepare($sql);
        $result->bindParam(':first_name', $user['first_name'], PDO::PARAM_STR);
        $result->bindParam(':last_name', $user['last_name'], PDO::PARAM_STR);
        $result->bindParam(':password', $user['password'], PDO::PARAM_STR);
        $result->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $result->bindParam(':work_position', $user['work_position'], PDO::PARAM_STR);
        $result->bindParam(':image', $user['image'], PDO::PARAM_STR);
        $result->bindParam(':status', $user['status'], PDO::PARAM_INT);
        $result->execute();

    }

    public static function adminDeleteUser($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM user WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute() ? true : false;
        
    }

    public static function adminUpdateUser($id, $userOptions)
    {
        $db = Db::getConnection();

        $sql = "UPDATE user SET " 
                . "first_name = :first_name, "
                . "last_name = :last_name, "
                . "password = :password, "
                . "email = :email, "
                . "work_position = :work_postion, "
                . "image = :image, "
                . "contacts = :contacts, "
                . "status = :status WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':first_name', $userOptions['first_name'], PDO::PARAM_STR);
        $result->bindParam(':last_name', $userOptions['last_name'], PDO::PARAM_STR);
        $result->bindParam(':password', $userOptions['password'], PDO::PARAM_STR);
        $result->bindParam(':email', $userOptions['email'], PDO::PARAM_STR);
        $result->bindParam(':work_position', $userOptions['work_position'], PDO::PARAM_STR);
        $result->bindParam(':image', $userOptions['image'], PDO::PARAM_STR);
        $result->bindParam(':contacts', $userOptions['contacts'], PDO::PARAM_STR);
        $result->bindParam(':status', $userOptions['status'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function adminGetAllUsers()
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM user");

        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $users[$i]['id'] = $row['id'];
            $users[$i]['first_name'] = $row['first_name'];
            $users[$i]['last_name'] = $row['last_name'];
            $users[$i]['email'] = $row['email'];
            $users[$i]['work_position'] = $row['work_position'];
            $users[$i]['image'] = $row['image'];
            $users[$i]['contacts'] = $row['contacts'];
            $users[$i]['status'] = $row['status'];
        }

        return $users;
    }
    // =============== / end ADMIN ACTION  


    // =============== START USER FORM VALIDATE ==============
    public static function checkPassword($password) 
    {   
        $pattern = '/([0-9]{6,24})/i';
        $pattern2 = '/([А-я])/i';
        if (preg_match($pattern, $password) && !preg_match($pattern2, $password)) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }
    // =============== / END USER FORM VALIDATE ======

    public static function getUserById($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM user WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

}