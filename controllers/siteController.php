<?php

        
class siteController
{
    public function actionIndex()
    {
        $categories=array();
        $categories= Category::getCategoryList();
        
        $prods=array();
        $prods=Product::getLatestProd(3);
        
        $sliderProducts = Product::getRecommendedProducts();
        
        require_once(ROOT.'/views/site/index.php');
        return true;
    }
    
    public function actionContacts()
    {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
    
            $errors = false;
                        
            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            
            if ($errors == false) {
                $adminEmail = 'nearokosmo@gmail.com';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Вопрос через форму обратной связи.';    
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }

        }
        
        require_once(ROOT . '/views/site/contacts.php');        
        return true;
    }
    
    public function actionAbout()
    {
        // Подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }
}

