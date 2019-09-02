<?php 

class AdminUserController
{
    public function actionIndex()
    {
        $users = User::adminGetAllUsers();
        
        require_once ROOT . '/views/admin/user/index.php';
        return true;
    }

    public function actionCreate()
    {   
        $errors = false;
        if (isset($_POST['submit']))
        {
            $newUser['first_name'] = $_POST['first_name'];
            $newUser['last_name'] = $_POST['last_name'];
            $newUser['password'] = $_POST['password'];
            $newUser['email'] = $_POST['email'];
            $newUser['image'] = $_FILES['image']['name'];
            $newUser['work_position'] = $_POST['work_postition'];
            $newUser['status'] = $_POST['status'];

            if (!User::checkEmail($newUser['email'])) {
                $errors[] = ' - Введите правильный Email!';
            }

            if (!User::checkPassword($newUser['password'])) {
                $errors[] = ' - Некорректный пароль!<br/>
                  (Пароль должен быть не короче 6ти символов, разрешены латинские символы и цифры)';
            }

            if (!$errors) {
                User::adminCreateUser($newUser);

                header('Location: /admin/user/');
            } 
        }

        require_once ROOT . '/views/admin/user/create.php';
        return true;
    }

    public function actionUpdate($id)
    {   
        $user = User::getUserById($id);
        
        $errors = false;
        if (isset($_POST['submit']))
        {
            $newUser['first_name'] = $_POST['first_name'];
            $newUser['last_name'] = $_POST['last_name'];
            $newUser['password'] = $_POST['password'];
            $newUser['email'] = $_POST['email'];
            $newUser['image'] = $_FILES['image']['name'];
            $newUser['work_position'] = $_POST['work_postition'];
            $newUser['status'] = $_POST['status'];

            if (!User::checkEmail($newUser['email'])) {
                $errors[] = ' - Введите правильный Email!';
            }

            if (!User::checkPassword($newUser['password'])) {
                $errors[] = ' - Некорректный пароль!<br/>
                  (Пароль должен быть не короче 6ти символов, разрешены латинские символы и цифры)';
            }

            if (!$errors) {
                User::adminUpdateUser($id, $newUser);

                header('Location: /admin/user/');
            } 
        }

        require_once ROOT . '/views/admin/user/update.php';
        return true;
    }

    public function actionDelete($id)
    {   
        $user = User::getUserById($id);

        if (isset($_POST['submit'])) {

            $result = User::adminDeleteUser($id);

            if ($result) header('Location: /admin/user/');
        }
        
        require_once ROOT . '/views/admin/user/delete.php';
        return true;
    }

}