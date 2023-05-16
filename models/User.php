<?php

class User {
    public static function register($name, $email, $password)
    {
        $db= Db::connect();
        
        $sql='INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
        
        $pass= password_hash($password, PASSWORD_DEFAULT);
        $result=$db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    public static function checkName($name)
    {
        if (strlen($name)>=2) 
        {
            return true;
        }
        return false;        
    }
    
    public static function checkPass($password)
    {
        if (strlen($password)>=6) 
        {
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
    
    public static function checkExists($email)
    {
        $db = Db::connect();
        $sql='SELECT count(*) FROM user WHERE email=:email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn())
            return true;
        return false;
    }
    
    public static function checkUserData($email, $password)
    {
        $db= Db::connect();
       
        $sql='SELECT * FROM user WHERE email=:email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $user=$result->fetch();
        if ($user){
        $hashed_pass=$user['password'];
        if ( password_verify ( $password , $hashed_pass )) {
                if ( password_needs_rehash($hashed_pass, PASSWORD_DEFAULT)) 
                {
                    $rehashed_pass = password_hash($password, PASSWORD_DEFAULT );
                }
     /* password verified, let the user in */
                return $user['id'];
        }
        else {
           return false;
        }
        
    }
    return false;
    }
    
    public static function auth($userid)
    {
        $_SESSION['user'] = $userid;              
    }
    
    public static function checkLogged()
    {
        if (isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        } 
         header('Location: /user/login');
    }
    
    public static function isGuest()
    {
        if (isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }
    
    public static function getUserById($id)
    {
        $db= Db::connect();
        $sql='SELECT * FROM user WHERE id='.$id;
        $result = $db->prepare($sql);
        $result->execute();
        $user=$result->fetch();
        if ($user)
            return $user;
        return false;
    }
    
     public static function edit($id, $name, $password)
    {
        $db= Db::connect();
        
        $sql='UPDATE user SET name=:name, password=:password WHERE id=:id';
        $pass= password_hash($password, PASSWORD_DEFAULT);
        $result=$db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
     public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

}

