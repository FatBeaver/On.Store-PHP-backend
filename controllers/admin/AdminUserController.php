<?php 

class AdminUserController extends AdminBase
{
    public function actionIndex($page = 1)
    {      
        self::checkAdmin();
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $total = User::getTotalCountUser();
        
        $pagination = new Pagination($total['count'], $limit, $page, 'admin/user');
        $users = User::adminGetAllUsers($limit, $offset);
        
        require_once ROOT . '/views/admin/user/index.php';
        return true;
    }

    public function actionCreate()
    {   
        self::checkAdmin();
        $errors = false;
        if (isset($_POST['submit']))
        {
            $updateUser['first_name'] = $_POST['first_name'];
            $updateUser['last_name'] = $_POST['last_name'];
            $updateUser['password'] = $_POST['password'];
            $updateUser['email'] = $_POST['email'];
            $updateUser['work_position'] = $_POST['work_postition'];
            $updateUser['status'] = $_POST['status'];

            if (!User::checkEmail($updateUser['email'])) {
                $errors[] = ' - Введите правильный Email!';
            }

            if (!User::checkPassword($updateUser['password'])) {
                $errors[] = ' - Некорректный пароль!<br/>
                  (Пароль должен быть не короче 6ти символов, разрешены латинские символы и цифры)';
            }

            if (!$errors) {
                User::adminCreateUser($updateUser);

                header('Location: /admin/user/');
            } 
        }

        require_once ROOT . '/views/admin/user/create.php';
        return true;
    }

    public function actionUpdate($id)
    {   
        self::checkAdmin();
        $user = User::getUserById($id);
        
        $errors = false;
        if (isset($_POST['submit']))
        {
            $updateUser['first_name'] = $_POST['first_name'];
            $updateUser['last_name'] = $_POST['last_name'];
            $updateUser['password'] = $_POST['password'];
            $updateUser['image'] = !empty($_FILES['image']['name']) ? FileImages::addImages('user') : $user['image'];
            $updateUser['email'] = $_POST['email'];
            $updateUser['contacts'] = '1';
            $updateUser['work_position'] = $_POST['work_postition'];
            $updateUser['status'] = $_POST['status'];
           
            if (!User::checkEmail($updateUser['email'])) {
                $errors[] = ' - Введите правильный Email!';
            }

            if (!User::checkPassword($updateUser['password'])) {
                $errors[] = ' - Некорректный пароль!<br/>
                  (Пароль должен быть не короче 6ти символов, разрешены латинские символы и цифры)';
            }

            if (!$errors) {
                User::adminUpdateUser($id, $updateUser);

                header('Location: /admin/user/');
            } 
        }

        require_once ROOT . '/views/admin/user/update.php';
        return true;
    }

    public function actionDelete($id)
    {   
        self::checkAdmin();
        $user = User::getUserById($id);

        if (isset($_POST['submit'])) {

            $result = User::adminDeleteUser($id);

            if ($result) header('Location: /admin/user/');
        }
        
        require_once ROOT . '/views/admin/user/delete.php';
        return true;
    }

}