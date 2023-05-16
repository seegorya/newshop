<?php

class cabinetController {
   
    public function actionIndex() 
    {
        $userId= User::checkLogged();
        $user = User::getUserById($userId);
        require_once(ROOT.'/views/cabinet/index.php');
        return true;
    }
    
     public function actionEdit()
    {
         $userId= User::checkLogged();
         $user= User::getUserById($userId);
        
         $name=$user['name'];
         $pass=$user['password'];
         
         $result=false;
        
        if (isset($_POST['submit']))
        {
            $name=$_POST['name'];
            $pass=$_POST['password'];
            $pass2=$_POST['password2'];
            $errors=false;
            if (!User::checkName($name))
            {
                $errors[]='Имя не должно быть короче 2-х символов.';
            }
            if (!User::checkPass($pass))
            {
                $errors[]='Пароль должен содержать более 6 символов.';
            }  
            if ($pass!=$pass2)
            {
                $errors[]='Пароли не совпадают.';
            }
            if ($errors==false)
            {
                $result= User::edit($userId, $name, $pass);
            }
        }
        require_once(ROOT.'/views/user/edit.php');
        return true;
    }
}
