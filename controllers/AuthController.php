<?php 

class AuthController
{
    public static function actionRegistration()
    {   
        $errors = false;
        if (isset($_POST['submit']))
        {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            
            if (!User::checkEmail($email)) {
                $errors[] = '<p> - Введите корректный Email адресс</p>';
            }
            if (!User::checkEmailExists($email)) {
                $errors[] = '<p> - Такой Email уже существует на сайте</p>';
            }
            if (!User::checkPassword($password)) {
                $errors[] = '<p> - Вы ввели некорректный пароль</p>';
            }
            
            if (!$errors) {
                $user_id = Auth::registration($first_name, $last_name, $email, $password);

                $_SESSION['user_id'] = $user_id;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['email'] = $email;

                setcookie('user_id', $_SESSION['user_id'], time() + 3600 * 24 * 30, '/');
                setcookie('first_name', $_SESSION['first_name'], time() + 3600 * 24 * 30, '/');
                setcookie('last_name',  $_SESSION['last_name'], time() + 3600 * 24 * 30, '/');
                setcookie('email',  $_SESSION['email'], time() + 3600 * 24 * 30, '/');

                header('Location: /blogpost/');
            }
        }

        require_once ROOT . '/views/auth/registration.php';
        return true;
    }


    public static function actionLogin()
    {   
        $errors = false;
        if (isset($_POST['submit']))
        {   
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!User::checkPassword($password)) {
                $errors[] = '<p>- Вы ввели некорректный пароль</p>';
            }
            if (!User::checkEmail($email)) {
                $errors[] = '<p> - Введите корректный Email адресс</p>';
            }

            if (!$errors) {
                if ($row = Auth::userLogin($email, $password)) {
                    
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['email'] = $row['email'];

                    setcookie('user_id', $row['id'], time() + 3600 * 24 * 30, '/');
                    setcookie('first_name', $row['first_name'], time() + 3600 * 24 * 30, '/');
                    setcookie('last_name',  $row['last_name'], time() + 3600 * 24 * 30, '/');
                    setcookie('email',  $row['email'], time() + 3600 * 24 * 30, '/');
                    
                    header('Location: /');
                }
                
                $errors = "<p>Ошибка авторизации пользователь с Email $email не найден</p>";    
            }
        }

        require_once ROOT . '/views/auth/login.php';
        return true;
    }


    public static function actionLogOut()
    {
        Auth::logOut();
        header('Location: /');
        require_once ROOT . '/views/site/index.php';
        return true;
    }
}