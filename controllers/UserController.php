<?php

class UserController
{
    
    public function actionRegister() 
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = FALSE;
            
            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть корорче 2-х символов';
            }
            
            if(!User::checkEmail($email)){
                $errors[] = 'Неправильный пароль'; 
            }
            
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть корорче 6-ти символов';
            }
            
            if(User::checkEmailExists($email)){
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors==FALSE){ 
                $result = User::register($name, $email, $password);
            }
            
        }

        require_once (ROOT.'/views/user/register.php');
        return true;
        
    }
    
    
    public function actionLogin() 
    {
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = FALSE;
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId == FALSE){ 
                $errors[] = 'Не праильные данные для входа на сайт';
            }
            else {
                User::auth($userId);
                
                header("Location: /cabinet/");
            }
      
    
          
            
            if ($errors==FALSE) {
                $result = User::register($name, $email, $password);
            }
            
        }

        require_once (ROOT.'/views/user/login.php');
        return true;
        
    }
    
    public function actionLogout($param) 
    {
        unset($_SESSION["user"]);
        header("Location: /");
    }
}